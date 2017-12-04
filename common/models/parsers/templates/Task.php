<?php
//Парсинг карточки товара
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\ParserTask;
use common\models\parsers\classes\ParserPagination;
use common\models\Error;

class {class_name} extends ParserTask
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
        $data=parent::parsPage();

        //Парсинг списка
        $items_selector='item_selector';
        $items=$this->document->find($items_selector);
        foreach ($items as $key => $item) {
            $model= new TaskParser();
            $model->parserAR=$this->parserAR;
            $model->requestAR=$this->requestAR;
            $model->responseAR=$this->responseAR;

            
            $model->setId( str_replace('project-item', '', pq($item)->attr('id')) );
            $model->setName( pq($item)->find('h2 a.b-post__link')->text() );
            

            $model->setPrice( pq($item)->find('.b-post__price')->text() );
            $model->setDescription( pq($item)->find('div.b-post__body div.b-post__txt')->text() );
            
            
            $model->setViewUrl( '{URL_SCHEME}://{URL_HOST}'.pq($item)->find('h2 a')->attr('href') );

            
            $model->setType( pq($item)->find('span.b-post__bold.b-layout__txt_inline-block')->text() );
            $model->setDate( pq($item)->find('span.b-post__txt.b-post__txt_fontsize_11.b-post__txt_overflow_hidden')->text() );
        
            $model->setViews( preg_replace('/\s\s+/', ' ', pq($item)->find('span.b-post__txt.b-post__txt_float_right.b-post__txt_fontsize_11.b-post__txt_bold.b-post__link_margtop_7')->text()) );
            $model->setAnswers( pq($item)->find('a.b-post__link.b-post__txt_float_right.b-post__link_bold.b-post__link_fontsize_11.b-post__link_color_4e.b-post__link_color_0f71c8_hover.b-post__link_margtop_7.b-page__desktop')->text() );


            if($model->validate()){
                $data['items'][]=$model->toArray();
            }else{
                $model->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга списка');
                $model->saveErrors();
                return false;
            }
        }

        //Парсинг pagination
        $pages_selector='page_selector';
        $pages=$this->document->find($items_selector);
        foreach ($pages as $key => $page) {
            $page = new ParserPagination();

            $page->title = pq($page)->find('page_num_selector')->attr('attr_name');
            $page->url = pq($page)->find('page_num_selector')->attr('attr_name');
            
            if($page->validate()){
                $data['pages'][]=$page->toArray();
            }else{
                if(isset($model)){
                    $model->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга раздела Pagination');
                    $model->saveErrors();    
                }
                
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

        $this->setId($this->document->find('span[lis-action="lisShowRating"]')->attr('lis-data-id'));
        $this->setName($this->document->find('h1[itemprop="name"]')->text());
        $this->setPrice($this->document->find('span[itemprop="price"]')->attr('content'));
        $this->setDescription( pq($item)->find('div.b-post__body div.b-post__txt')->text() );
        $this->setCurrency($this->document->find('span[itemprop="priceCurrency"]')->attr('content'));
        $this->setViewUrl(null);
        $this->setType( pq($item)->find('span.b-post__bold.b-layout__txt_inline-block')->text() );
        $this->setDate( pq($item)->find('span.b-post__txt.b-post__txt_fontsize_11.b-post__txt_overflow_hidden')->text() );
        $this->setViews( preg_replace('/\s\s+/', ' ', pq($item)->find('span.b-post__txt.b-post__txt_float_right.b-post__txt_fontsize_11.b-post__txt_bold.b-post__link_margtop_7')->text()) );
        $this->setAnswers( pq($item)->find('a.b-post__link.b-post__txt_float_right.b-post__link_bold.b-post__link_fontsize_11.b-post__link_color_4e.b-post__link_color_0f71c8_hover.b-post__link_margtop_7.b-page__desktop')->text() );

        

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
