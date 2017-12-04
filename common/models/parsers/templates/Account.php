<?php
//Парсинг карточки товара
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\ParserAccount;
use common\models\parsers\classes\ParserPagination;
use common\models\Error;

class {class_name} extends ParserAccount
{
    public $parsActions=[
        'actionParsList'=>'{list_selector}',
        'actionParsItem'=>'{item_selector}',
    ];
    public $testUrls=[
        'actionParsList'=>'{list_test_url}',
        'actionParsItem'=>'{item_test_url}',
    ];
    

    //Парсинг списка 
    public function actionParsList()
    {
        $items_selector='';
        $items=$this->document->find($items_selector);

        $data=parent::parsPage();

        foreach ($items as $key => $item) {
            $model= new ParserAccount();
            $model->parserAR=$this->parserAR;
            $model->requestAR=$this->requestAR;
            $model->responseAR=$this->responseAR;

            //$model->setAttrOne( pq($item)->find('')->text() );
            //$model->setAttrTwo( pq($item)->find('')->text() );

            if($model->validate()){
                $data['items'][]=$model->toArray();
            }else{
                $model->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга списка');
                $model->saveErrors();
                return false;
            }
        }
        return json_encode($data,JSON_UNESCAPED_UNICODE);
        
    }
    
    //Парсинг записи 
    public function actionParsItem()
    {

        $data=parent::parsPage();

        $item_selector='';
        $item=$this->document->find($item_selector);

        //$this->setAttrOne( pq($item)->find('')->text() );
        //$this->setAttrTwo( pq($item)->find('')->text() );
        

        if($this->validate()){
            $data=array_merge($data,$this->toArray);
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            $this->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга записи');
            $this->saveErrors();
            return false;
        }
        
    }

}
