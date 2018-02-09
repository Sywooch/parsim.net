<?php

namespace backend\models;

use Yii;
use ZipArchive;

use yii\base\Model;
use yii\web\UploadedFile;
use common\models\Parser;
use common\models\ParserAction;
use common\models\Error;

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

            if($this->file->saveAs($file)){
                $zip = new ZipArchive;

                if ($zip->open($file) === TRUE) {
                    
                    
                    //Загружаю новые файлы
                    $zip->extractTo($extract_path);
                    $zip->close();

                    $parsers=json_decode(file_get_contents($extract_path.'InitParsData.json'),true);

                    if(count($parsers)>0){
                        $error=new Error();
                        $error->parser_id=$model->id;
                        $error->status=Error::STATUS_NEW;
                        $error->code=Error::CODE_IMPORT_ERROR;
                        $error->description='Список пуст';
                        $error->save();

                    }
                    foreach ($parsers as $key => $parser) {
                        $model=Parser::findOne(['name'=>$parser['name']]);
                        
                        if(!isset($model)){
                            $model=new Parser();
                        }
                        
                        $model->name=$parser['name'];
                        $model->type_id=$parser['type_id'];
                        $model->reg_exp=$parser['reg_exp'];
                        $model->loader_type=$parser['loader_type'];
                        //$model->example_url=$parser['example_url'];
                        $model->status=$parser['status'];
                        $model->description=$parser['description'];
                        
                        if($model->save()){
                            if(is_array($parser['actions'])){
                                foreach ($parser['actions'] as $action) {
                                    $modelAction=ParserAction::findOne(['parser_id'=>$model->id,'name'=>$action['name']]);

                                    if(!isset($modelAction)){
                                        $modelAction=new ParserAction();
                                    }

                                
                                    $modelAction->parser_id=$model->id;
                                    $modelAction->name=$action['name'];
                                    $modelAction->seq=$action['seq'];
                                    $modelAction->status=$action['status'];
                                    $modelAction->selector=(isset($action['selector'])?$action['selector']:null);
                                    $modelAction->example_url=$action['example_url'];
                                    $modelAction->code=(isset($action['code'])?$action['code']:null);
                                    $modelAction->description=(isset($action['description'])?$action['description']:null);
                                    
                                    $modelAction->save();    
                            
                                    
                                }
                            }

                        }else{
                            $error=new Error();
                            $error->parser_id=$model->id;
                            $error->status=Error::STATUS_NEW;
                            $error->code=Error::CODE_IMPORT_ERROR;
                            $error->description='Ошибка импорта парсера '.$model->name.' ('.json_encode($model->errors).')';
                            $error->save();
                        }
                        
                    }


                    return true;

                } else {
                    $error=new Error();
                    $error->parser_id=$model->id;
                    $error->status=Error::STATUS_NEW;
                    $error->code=Error::CODE_IMPORT_ERROR;
                    $error->description='Ошибка чтения zip-файла';
                    $error->save();
                    return false;
                }
                return true;

            }else{
                $error=new Error();
                $error->parser_id=$model->id;
                $error->status=Error::STATUS_NEW;
                $error->code=Error::CODE_IMPORT_ERROR;
                $error->description='Ошибка записи файла';
                $error->save();
                
                return false;
            }

            
        } else {
            $error=new Error();
            $error->parser_id=$model->id;
            $error->status=Error::STATUS_NEW;
            $error->code=Error::CODE_IMPORT_ERROR;
            $error->description='Ошибка валидации формы ('.json_encode($this->errors).')';
            $error->save();
            
            return false;
        }
    }
}

?>