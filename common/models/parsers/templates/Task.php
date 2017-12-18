<?php
//Парсинг карточки задачи
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\ParserTask;
use common\models\parsers\classes\ParserPagination;
use common\models\Error;

class {class_name} extends ParserTask
{
    public $actions=[
        'parsList'=>[
            'selectors'=>[
                'items'=>'{ITEMS_SELECTOR}',
                'pages'=>'{PAGES_SELECTOR}',
            ],
            'test_url'=>'{ITEMS_TEST_URL}',
        ],
        'parsItem'=>[
            'selectors'=>[
                'item'=>'{ITEM_SELECTOR}',
            ],
            'test_url'=>'{ITEM_TEST_URL}',
        ],
    ];
    

    //Парсинг списка 
    public function actionParsList()
    {
        $data=parent::parsPage();
        $base_url=parse_url($this->testUrls['actionParsList'], PHP_URL_SCHEME).'://'.parse_url($this->testUrls['actionParsList'], PHP_URL_HOST);

        //Парсинг списка
        $items_selector=$this->parsActions['actionParsList'];
        $items=$this->document->find($items_selector);

        foreach ($items as $key => $item) {
            $model= new TaskParser();
            $model->parserAR=$this->parserAR;
            $model->requestAR=$this->requestAR;
            $model->responseAR=$this->responseAR;

            
            $model->id =str_replace('project-item', '', pq($item)->attr('id'));
            $model->name = pq($item)->find('h2 a.b-post__link')->text();
            $model->viewUrl=$base_url.pq($item)->find('h2 a')->attr('href');
            

            $model->setPrice( pq($item)->find('.b-post__price')->text() );
            $model->setDescription( pq($item)->find('div.b-post__body div.b-post__txt')->text() );
            
            
            

            
            $model->setType( pq($item)->find('span.b-post__bold.b-layout__txt_inline-block')->text() );
            $model->setDate( pq($item)->find('span.b-post__txt.b-post__txt_fontsize_11.b-post__txt_overflow_hidden')->text() );
        
            $model->setViews( preg_replace('/\s\s+/', ' ', pq($item)->find('span.b-post__txt.b-post__txt_float_right.b-post__txt_fontsize_11.b-post__txt_bold.b-post__link_margtop_7')->text()) );
            $model->setAnswers( pq($item)->find('a.b-post__link.b-post__txt_float_right.b-post__link_bold.b-post__link_fontsize_11.b-post__link_color_4e.b-post__link_color_0f71c8_hover.b-post__link_margtop_7.b-page__desktop')->text() );


            if($model->validate()){
                $data['items'][]=$model->toArray();
            }else{
                $this->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга списка');
                if($this->testMode==false){
                    $this->saveErrors();    
                }
                return false;
            }
        }

        //Парсинг pagination
        $pages_selector='page_selector';
        $pages=$this->document->find($items_selector);
        foreach ($pages as $key => $item) {
            $page = new ParserPagination();

            $page->title = pq($item)->find('page_num_selector')->attr('attr_name');
            $page->url = pq($item)->find('page_num_selector')->attr('attr_name');
            
            if($page->validate()){
                $data['pages'][]=$page->toArray();
            }else{
                if(isset($model)){
                    $this->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга раздела Pagination');
                    if($this->testMode==false){
                        $this->saveErrors();    
                    }
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
            if($this->testMode==false){
                $this->saveErrors();    
            }
            return false;
        }
        
    }

}
