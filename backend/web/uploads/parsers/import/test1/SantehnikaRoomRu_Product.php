<?php
//Парсинг карточки товара
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\ParserProduct;
use common\models\Error;

class SantehnikaRoomRu_Product extends ParserProduct
{
    public $parsActions=[
        'actionParsList'=>'',
        'actionParsItem'=>'',
    ];
    public $testUrls=[
        'actionParsList'=>'', //в классе наследнике указывается эталонный URL, по которому проверяется корректность работы действия - парсинг списка
        'actionParsItem'=>'', //в классе наследнике указывается эталонный URL, по которому проверяется корректность работы действия - парсинг записи
    ];
    

    //Парсинг списка 
    public function actionParsList()
    {
        $items_selector='';
        $items=$this->document->find($items_selector);

        $data=parent::parsPage();

        foreach ($items as $key => $item) {
            $model= new ParserProduct();

            $model->setAttrOne( pq($item)->find('')->text() );
            $model->setAttrTwo( pq($item)->find('')->text() );

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

        $this->setAttrOne( pq($item)->find('')->text() );
        $this->setAttrTwo( pq($item)->find('')->text() );
        

        if($this->validate()){
            $data=array_merge($data,$this->toArray);
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            $model->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга записи');
            $model->saveErrors();
            return false;
        }
        
    }

}
