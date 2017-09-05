<?php
namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\Html;

class Image extends \yii\db\ActiveRecord
{
    //Режимы создания миниатюр
    const MODE_CUT=0; //обрезаем лишнее, подгоняем точно в формат
    const MODE_FILL_WHIT=1; //не обрезаем лишнее, заполняем белым до формата
    const MODE_RESIZE=2; //просто уменьшаем чтобы влезло в формат

    const SCENARIO_CREATE_BY_FILE='CREATE_BY_FILE';
    const SCENARIO_CREATE_BY_DATA='CREATE_BY_DATA';

    public static function tableName()
    {
        return 'image';
    }


    public $upload_dir='uploads/';
    public $previews=[];
    
    public $defaultImgPath='/images/blank.png';

    public function rules()
    {
        return [
            [['fileToUpload'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif, svg', 'on'=>self::SCENARIO_CREATE_BY_FILE],
            [['dataToUpload'], 'required','on'=>self::SCENARIO_CREATE_BY_DATA],
            [['crop_x','crop_y','crop_width','crop_height'], 'integer']
        ];
    }



    /*=================================================
    /
    /   Getters & Setters
    /
    ================================================= */
    private $_fileToUpload;
    public function setFileToUpload($value){
        $this->_fileToUpload=$value;
        if($this->_fileToUpload instanceOf UploadedFile){
            $this->name=$this->_fileToUpload->name;
            $this->size=$this->_fileToUpload->size;
            $this->src=uniqid().'.'.$this->_fileToUpload->extension;    
        }else{
            $this->_fileToUpload=null;
        }
    }
    public function getFileToUpload(){
        return $this->_fileToUpload;
    }

    private $_dataToUpload;
    public function setDataToUpload($value){
        

        $this->_dataToUpload=$value;
        if( is_array($this->_dataToUpload)){
            
            $this->name=$this->_dataToUpload['name'];
            $this->size=$this->_dataToUpload['size'];
            $this->base64=$this->_dataToUpload['base64'];
            $ext=explode('.',$this->_dataToUpload['name'])[1];
            $this->src=uniqid().'.'.$ext;    

            
        }else{
            $this->_dataToUpload=null;
        }
    }
    public function getDataToUpload(){
        return $this->_dataToUpload;
    }

    private $_base64;
    public function setBase64($value){
        $this->_base64=$value;
    }
    public function getBase64(){
        return $this->_base64;
    }

    public function getFullPath(){
        return $this->upload_dir.$this->src;
    }

    public function getImgSrc($size=null){
        $src=$this->src;
        if(isset($size)){
            $src_array=explode('.',$this->src);
            $src=$src_array[0].'_'.$size.'.'.$src_array[1];
        }
        
        $srcPpath='/'.$this->upload_dir.$src;
        //if(!file_exists($srcPpath)){
        //    $srcPpath=$this->defaultImgPath;
        //}
        return $srcPpath; //'/'.$this->upload_dir.$src;
    }

    public function getImg($size=null,$options=[]){
        
        return Html::img($this->getImgSrc($size),$options);
    }


    /*=================================================
    /
    /   AR Events
    /
    ================================================= */

    //перед сохранением в БД пытаюсь сохранить файл на диск
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        return $this->uploadFile();
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }
        return $this->removeFile();
    }


    /*=================================================
    /
    /   File functions
    /
    ================================================= */
    //Сохранение файла на диске
    private function uploadFile()
    {
        
        if ($this->validate()){

            if($this->scenario==self::SCENARIO_CREATE_BY_DATA){
                $base64=$this->_base64;
                $data = explode(',', $base64);
                $imgdata  = base64_decode($data[1]);
                file_put_contents($this->fullPath,$imgdata);
            }
            
            if($this->scenario==self::SCENARIO_CREATE_BY_FILE){
                //сохраняю оригинальный файл изображения
                $this->fileToUpload->saveAs($this->fullPath);
            }

            
            //После сохранения файла на диск заполняю размеры изображения в БД
            $t=getimagesize($this->fullPath);

            $this->width=$t[0];
            $this->height=$t[1];

            //$this->crop_width=$t[0];
            //$this->crop_height=$t[1];
            
            //создаю и сохраняю миниатюры изображения
            $this->createThumbs();
            

            return true;
        }else{
            return false;
        }

        return false;
    }

    

    //Удаление файла с диска
    private function removeFile(){
        if(file_exists($this->fullPath)){
            
            //Удаляю миниатюры
            $src_array=explode('.',$this->src);
            $mask = $this->upload_dir.$src_array[0].'_*.*';
            
            foreach (glob($mask) as $filename) {
                unlink($filename);
            }

            //Удаляю основное изображение
            return unlink($this->fullPath);
        }
        return true;
    }

    private function createThumbs(){
        
        foreach ($this->previews as $key => $preview) {
            $src_array=explode('.',$this->src);
            $dist_file=$this->upload_dir.$src_array[0].'_'.$key.'.'.$src_array[1];

            $width=$preview['width'];

            $height=0;
            if(array_key_exists('height', $preview))
                $height=$preview['height'];

            $mode=0;
            if(array_key_exists('mode', $preview))
                $mode=$preview['mode'];

            $this->createThumb($this->getFullPath(),$dist_file,$width,$height,$mode);
            
        }
    }
    

    //----------------------------------------------------------------------------
    function createThumb($file_src, $file_dest, $width, $height=0, $mode=0)
    //---------------------------------------------------------------------------- 

    //$mode 
    // 0 - обрезаем лишнее, подгоняем точно в формат
    // 1 - не обрезаем лишнее, заполняем белым до формата
    // 2 - просто уменьшаем чтобы влезло в формат

    {

        global $_error;
        $t=getimagesize($file_src);

        $us=0;
        if($t[2]==1)
        $us=@imagecreatefromgif($file_src);

        if($t[2]==2)
        $us=@imagecreatefromjpeg($file_src);

        if($t[2]==6)
        $us=@imagecreatefromwbmp($file_src);

        if($t[2]==3)
        $us=@imagecreatefrompng($file_src);

        if(!$us){$_error['image']=1; return 0;}

        $x=imagesx($us);
        $y=imagesy($us);

        $f_src=$x/$y;

        if($height==0)
        $height=$width/$f_src;

        if($width==0)
        $width=$height*$f_src;

        $f_dest=$width/$height;


        if($width>=$x&&$height>=$y){
            copy($file_src,$file_dest);
            return 0;}



        if($mode==0)//inner cut
        {
            $f_dest=$width/$height;
            if($f_dest>$f_src)
            {
            $new_w=$x;
            $new_h=$x/$f_dest;
            $new_x=0;
            $new_y=($y-$new_h)/2;
            }
            else
            {
            $new_w=$y;
            $new_h=$y*$f_dest;
            $new_x=($x-$new_w)/2;
            $new_y=0;
            }

            $rez=imagecreatetruecolor($width,$height);
            imagecopyresampled($rez,$us,0,0,$new_x,$new_y,$width+1,$height,$new_w,$new_h);
        }

        if($mode==1)//outer fill
        {

            if($x>$y)
            {
            $new_w=$width;
            $new_h=$new_w/$f_src;
            $new_x=0;
            $new_y=($height-$new_h)/2;
            }
            else
            {
            $new_h=$height;
            $new_w=$new_h*$f_src;
            $new_y=0;
            $new_x=($width-$new_w)/2;
            }

            $rez=imagecreatetruecolor($width,$height);
            $bg=imagecolorallocate($rez, 255, 255, 255);
            imagefill ( $rez, 1, 1, $bg);
            imagecopyresampled ( $rez, $us, $new_x, $new_y, 0, 0, $new_w, $new_h, $x, $y);
        }

        if($mode==2)//outer
        {

            if($x>$y)
            {
            $new_w=$width;
            $new_h=$new_w/$f_src;
            $new_x=0;
            $new_y=($height-$new_h)/2;
            }
            else
            {
            $new_h=$height;
            $new_w=$new_h*$f_src;
            $new_y=0;
            $new_x=($width-$new_w)/2;
            }

            $rez=imagecreatetruecolor($new_w,$new_h);
            imagecopyresampled ( $rez, $us, 0, 0, 0, 0, $new_w, $new_h, $x, $y);
        }


        imagejpeg($rez,$file_dest,80);
    }

    private function getImageFromSrcFile(){
        $t=getimagesize($this->fullPath);
        $img=0;
        if($t[2]==IMG_GIF)
            $img=@imagecreatefromgif($this->fullPath);

        if($t[2]==IMG_JPG)
            $img=@imagecreatefromjpeg($this->fullPath);

        if($t[2]==IMG_WBMP)
            $img=@imagecreatefromwbmp($this->fullPath);

        if($t[2]==3)
            $img=@imagecreatefrompng($this->fullPath);

        return $img;

    }

    private function createPreviewFiles(){
        
        $quality=80;
        foreach ($this->previewsArray as $key => $options) {
            
            $width=$options['width'];
            $height=$options['height'];

            $src_array=explode('.',$this->src);
            $path = $this->file->uploadPath.$src_array[0].'_'.$key.'.'.$src_array[1];
            

            $img=$this->getImageFromSrcFile();
            $img_rez=imagecreatetruecolor($width,$height);
            imagecopyresampled($img_rez,$img,0,0,$this->crop_x,$this->crop_y,$width,$height,$this->crop_width,$this->crop_height);
            imagejpeg($img_rez,$path,$quality);
        }
    }




    
}
?>