<?php

namespace backend\models;

use Yii;
use ZipArchive;

use yii\base\Model;
use yii\web\UploadedFile;
use common\models\Parser;

class importForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'zip'],
        ];
    }
    
    public function upload()
    {

        if ($this->validate()) {
            $path=Yii::getAlias('@webroot/uploads/parsers/import/');
            $extract_path=Parser::getClassDir();//Yii::getAlias('@common/models/parsers');



            $file=$path.$this->file->baseName . '.' . $this->file->extension;

            $this->file->saveAs($file);

            $zip = new ZipArchive;
            

            if ($zip->open($file) === TRUE) {
                
                
                //Загружаю новые файлы
                $zip->extractTo($extract_path);
                $zip->close();

                return true;

            } else {

                return false;
            }

            return true;
        } else {
            return false;
        }
    }
}

?>