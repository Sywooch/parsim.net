<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\widgets;

use yii\bootstrap\Widget;

class ImageSelector extends Widget
{

    public $multiple=false;

    public $addBtnTitle="Добавить файл";
    public $deleteBtnTitle="Удалить файл";
    public $contentLabel="Добавьте файл";


    public $model;

    //Options for single mode
    public $fileInputAttr='fileInput';
    public $fileIdAttr='file_id';
    public $fileDataAttr='file_data';
    public $fileRelationAttr='files';

    public $showPreview=true;
    public $previewSize=null;
    public $previewOptions=[];
    public $defaultPrviewImage='/images/blank.png';

    public $options=[
        'class'=>'file-place',
    ];


    

    public function init()
    {
        ImageSelectorAsset::register( $this->getView() );
        parent::init();
        
        
    }

    public function run()
    {   
        $viewConf=[
            'id'=>$this->id,
            
            //Title attributes
            'addBtnTitle'=>$this->addBtnTitle,
            'deleteBtnTitle'=>$this->deleteBtnTitle,
            'contentLabel'=>$this->contentLabel,

            'showPreview'=>$this->showPreview,
            'previewSize'=>$this->previewSize,
            'previewOptions'=>$this->previewOptions,
            'defaultPrviewImage'=>$this->defaultPrviewImage,

            'model'=>$this->model,
            'fileInputAttr'=>$this->fileInputAttr,
            'fileIdAttr'=>$this->fileIdAttr,
            'fileDataAttr'=>$this->fileDataAttr,
            'fileRelationAttr'=>$this->fileRelationAttr,

            //HTML Options
            'options'=>$this->options,
        ];

        $view="ImageSelector/single";
        if($this->multiple){
            $view="ImageSelector/multiple";
        }

        return $this->render($view,$viewConf);
        
    }
}