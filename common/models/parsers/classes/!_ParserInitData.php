<?php

namespace common\models\parsers\classes;
use yii\base\Model;

class ParserInitData extends Model
{
    

    public static function getInitData()
    {
        
        return [
            //dushevoi.ru
            [
                'type_id'=>2,
                'name'=>'Список товаров на dushevoi.ru',
                'reg_exp'=>'(?!^.*-ware)(^https?://.*dushevoi.ru/products/)',
                'example_url'=>'https://www.dushevoi.ru/products/dushevye-kabiny/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на dushevoi.ru',
                'reg_exp'=>'^https?://.*dushevoi.ru/products/.*-ware/?$',
                'example_url'=>'https://www.dushevoi.ru/products/dushevaya-kabina-bolu-bl-11290m-pentas-110825-ware/',
            ],
            
            //santehnika-online.ru
            [
                'type_id'=>2,
                'name'=>'Список товаров на santehnika-online.ru',
                'reg_exp'=>'(?!^.*/product/)^(http[s]?://[\w.]*santehnika-online.ru[\w./-]*)$',
                'example_url'=>'https://santehnika-online.ru/vanny/stalnye/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на santehnika-online.ru',
                'reg_exp'=>'^(http[s]?://[\w.]*santehnika-online.ru/product/[\w./-]*)$',
                'example_url'=>'https://santehnika-online.ru/product/dushevoy_boks_aqualux_aq_4075gfh/',
            ],

            //center-santehniki.ru
            [
                'type_id'=>2,
                'name'=>'Список товаров на center-santehniki.ru',
                'reg_exp'=>'(?!^.*html$)(^http[s]?://[\w.]*center-santehniki.ru/catalog/)',
                'example_url'=>'https://center-santehniki.ru/catalog/vanny/akrilovye/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на center-santehniki.ru',
                'reg_exp'=>'^http[s]?://[\w.]*center-santehniki.ru/catalog/.*html$',
                'example_url'=>'https://center-santehniki.ru/catalog/vanny/akrilovye/akrilovaya-vanna-kolpa-san-accordo-140x70s-basis.html',
            ],

            //center-santehniki.ru
            [
                'type_id'=>2,
                'name'=>'Список товаров на djakudza.ru',
                'reg_exp'=>'(^https?://.*djakudza.ru/category/)',
                'example_url'=>'http://www.djakudza.ru/category/dushevye-kabiny/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на сайте djakudza.ru',
                'reg_exp'=>'(^https?://.*djakudza.ru/product/)',
                'example_url'=>'http://www.djakudza.ru/product/dushevaja-kabina-niagara-ng-2508g-900h900h2200-s-vysokim-poddonom-6-fors-steklo-tonirovannoe/',
            ],

            //aquatika.ru
            [
                'type_id'=>2,
                'name'=>'Список товаров на aquatika.ru',
                'reg_exp'=>'(^https?://.*aquatika.ru/prods_.*html$)',
                'example_url'=>'http://www.aquatika.ru/prods_radius.html',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на aquatika.ru',
                'reg_exp'=>'(^https?://.*aquatika.ru/item_.*html$)',
                'example_url'=>'http://www.aquatika.ru/item_arena.html',
            ],

            //http://santehnika-tut.ru/k23635.html
            [
                'type_id'=>2,
                'name'=>'Список товаров на santehnika-tut.ru',
                'reg_exp'=>'(?!^.*html$)(^http[s]?://[\w.]*santehnika-tut.ru/)',
                'example_url'=>'http://santehnika-tut.ru/dushevye-kabiny/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на santehnika-tut.ru',
                'reg_exp'=>'(^https?://.*santehnika-tut.ru/.*html$)',
                'example_url'=>'http://santehnika-tut.ru/k23635.html',
            ],

            //https://www.santehgorod.ru/catalog/kabiny/river_rein_9026_mt.html
            [
                'type_id'=>2,
                'name'=>'Список товаров на santehgorod.ru',
                'reg_exp'=>'(?!^.*html$)(^http[s]?://[\w.]*santehgorod.ru/catalog/)',
                'example_url'=>'https://www.santehgorod.ru/catalog/kabiny/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на santehgorod.ru',
                'reg_exp'=>'(^https?://.*santehgorod.ru/catalog/.*html$)',
                'example_url'=>'https://www.santehgorod.ru/catalog/kabiny/river_rein_9026_mt.html',
            ],
            
            //http://www.aquadom.ru/dushevie_kabini_boksi/dushevaya_kabina_niagara_ng_510_bez_bani/
            /*
            [
                'type_id'=>2,
                'name'=>'Список товаров на aquadom.ru',
                'reg_exp'=>'(^https?://.*aquadom.ru)',
                'example_url'=>'http://www.aquadom.ru/rakovini/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на aquadom.ru',
                'reg_exp'=>'(^https?://.*aquadom.ru)',
                'example_url'=>'http://www.aquadom.ru/dushevie_kabini_boksi/dushevaya_kabina_niagara_ng_510_bez_bani/',
            ],
            */

            //dlyavann.ru
            [
                'type_id'=>2,
                'name'=>'Список товаров на dlyavann.ru',
                'reg_exp'=>'(^http[s]?://[\w.]*dlyavann.ru/category/.*html$)',
                'example_url'=>'http://www.dlyavann.ru/category/unitazy.html',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на dlyavann.ru',
                'reg_exp'=>'(^https?://.*dlyavann.ru/item/.*html$)',
                'example_url'=>'http://www.dlyavann.ru/item/unitaz-napolnyy-roca-victoria-342399000.html',
            ],
            

            //perfekto.ru
            /*
            [
                'type_id'=>2,
                'name'=>'Список товаров на perfekto.ru',
                'reg_exp'=>'',
                'example_url'=>'https://www.perfekto.ru/catalog/unitazy/unitaz_artic_4310_gb114310301737_gb114310301231/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на perfekto.ru',
                'reg_exp'=>'',
                'example_url'=>'https://www.perfekto.ru/catalog/unitazy/',
            ],
            */

            //sanone.ru
            [
                'type_id'=>2,
                'name'=>'Список товаров на sanone.ru',
                'reg_exp'=>'(?!^.*html$)(^http[s]?://[\w.]*sanone.ru/)',
                'example_url'=>'http://sanone.ru/mebel_dlya_vannoy/alta-marea/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на sanone.ru',
                'reg_exp'=>'(^https?://.*sanone.ru/.*html$)',
                'example_url'=>'http://sanone.ru/mebel_dlya_vannoy/alta-marea-atollo-komplekt-mebeli.html',
            ],
            //https://www.santehnika-room.ru/dushevye-kabiny/assimetrichnye/dushevaya-kabina-niagara-ng-2310r-ng-2310r
            /*
            [
                'type_id'=>2,
                'name'=>'Список товаров на sanone.ru',
                'reg_exp'=>'(^http[s]?://[\w.]*santehnika-room.ru/)',
                'example_url'=>'https://www.santehnika-room.ru/unitazy/napolnye',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на sanone.ru',
                'reg_exp'=>'(^https?://.*santehnika-room.ru/.*html$)',
                'example_url'=>'https://www.santehnika-room.ru/dushevye-kabiny/assimetrichnye/dushevaya-kabina-niagara-ng-2310r-ng-2310r',
            ],
            */

            //santehtop.ru
            /*
            [
                'type_id'=>2,
                'name'=>'Список товаров на santehtop.ru',
                'reg_exp'=>'(?!^.*html$)(^http[s]?://[\w.]*sanone.ru/)',
                'example_url'=>'http://www.santehtop.ru/vanny/akrilovie/aquatika/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на santehtop.ru',
                'reg_exp'=>'(^https?://.*sanone.ru/.*html$)',
                'example_url'=>'http://www.santehtop.ru/aquatika-junior/',
            ],
            */

            //sanberry.ru
            /*
            [
                'type_id'=>2,
                'name'=>'Список товаров на sanberry.ru',
                'reg_exp'=>'(?!^.*html$)(^http[s]?://[\w.]*sanone.ru/)',
                'example_url'=>'http://sanberry.ru/catalog/sanfayans/unitazy/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на sanberry.ru',
                'reg_exp'=>'(^https?://.*sanone.ru/.*html$)',
                'example_url'=>'http://sanberry.ru/catalog/sanfayans/unitazy/kompakt_della_boston_oak_024/',
            ],
            */

            //http://santeh-era.ru/catalog/dushevye_kabiny_bez_para/dushevaya_kabina_niagara_ng_2310r/
            /*
            [
                'type_id'=>2,
                'name'=>'Список товаров на santeh-era.ru',
                'reg_exp'=>'(?!^.*html$)(^http[s]?://[\w.]*sanone.ru/)',
                'example_url'=>'http://santeh-era.ru/catalog/vanny_chugunnye/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на santeh-era.ru',
                'reg_exp'=>'(^https?://.*sanone.ru/.*html$)',
                'example_url'=>'http://santeh-era.ru/catalog/dushevye_kabiny_bez_para/dushevaya_kabina_niagara_ng_2310r/',
            ],
            */
            //https://sdvk.ru/Dushevie_kabini/niagara-ng-2310-group/
            /*
            [
                'type_id'=>2,
                'name'=>'Список товаров на sdvk.ru',
                'reg_exp'=>'(?!^.*html$)(^http[s]?://[\w.]*sanone.ru/)',
                'example_url'=>'https://sdvk.ru/Dushevie_kabini/Niagara/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на sdvk.ru',
                'reg_exp'=>'(^https?://.*sanone.ru/.*html$)',
                'example_url'=>'https://sdvk.ru/Dushevie_kabini/niagara-ng-2310-group/',
            ],
            */

            //http://www.santehnica.ru/product/64140.html
            [
                'type_id'=>2,
                'name'=>'Список товаров на santehnica.ru',
                'reg_exp'=>'(?!^.*html$)(^http[s]?://[\w.]*santehnica.ru/catalog/)',
                'example_url'=>'http://www.santehnica.ru/catalog/dushevie-kabini/niagara/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на santehnica.ru',
                'reg_exp'=>'(^https?://.*santehnica.ru/product/.*html$)',
                'example_url'=>'http://www.santehnica.ru/product/64140.html',
            ],

            //https://wodolei.ru/catalog/dushevie_kabini/niagara-ng-2310-r-101016-item/
            [
                'type_id'=>2,
                'name'=>'Список товаров на wodolei.ru',
                'reg_exp'=>'(?!^.*-item[/]?$)(^http[s]?://[\w.]*wodolei.ru/catalog/)',
                'example_url'=>'https://wodolei.ru/catalog/dushevie_kabini/Niagara/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на wodolei.ru',
                'reg_exp'=>'(^http[s]?://.*wodolei.ru/catalog/.*-item[/]?$)',
                'example_url'=>'https://wodolei.ru/catalog/dushevie_kabini/niagara-ng-2310-r-101016-item/',
            ],

            //https://www.santeh-import.ru/Dushevaya-kabina-River-Rein-90x90x210-REIN-9026-kupit-goods_190442.html?d=190430
            [
                'type_id'=>2,
                'name'=>'Список товаров на santeh-import.ru',
                'reg_exp'=>'(^http[s]?://.*santeh-import.ru/.*category_.*html$)',
                'example_url'=>'https://www.santeh-import.ru/Vanny-Vanny-pryamougolnye%2C-kvadratnye-kupit-category_438-b0.html',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на santeh-import.ru',
                'reg_exp'=>'(^http[s]?://.*santeh-import.ru/.*goods_.*html$)',
                'example_url'=>'https://www.santeh-import.ru/Vanna-Quaryl-Villeroy-%26-Boch-New-Generation-UBQ194AVE9-kupit-goods_96598.html',
            ],

            //http://santeh-mag.com/katalog/dushevye-kabiny/dushevaya-kabina-river-rein-90-26-mt/?sphrase_id=21332
            /*
            [
                'type_id'=>2,
                'name'=>'Список товаров на santeh-magt.ru',
                'reg_exp'=>'(?!^.*\w+-\d+$)(^http[s]?://.*santeh-mag.com/katalog/)',
                'example_url'=>'http://santeh-mag.com/katalog/dushevye-boksy/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на santeh-mag.ru',
                'reg_exp'=>'(?=^.*\w+-\d+$)(^http[s]?://.*santeh-mag.com/katalog/)',
                'example_url'=>'http://santeh-mag.com/katalog/podvesnye/unitaz-axa-one-1401001/',
            ],
            */



            //http://www.techport.ru/katalog/products/santehnika/dushevye-kabiny/dushevaja-kabina-niagara-ng-510-421463
            /*
            [
                'type_id'=>2,
                'name'=>'Список товаров на techport.ru',
                'reg_exp'=>'(^http[s]?://.*santeh-import.ru/.*category_.*html$)',
                'example_url'=>'http://www.techport.ru/katalog/products/santehnika/vanny',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на techport.ru',
                'reg_exp'=>'(^http[s]?://.*santeh-import.ru/.*goods_.*html$)',
                'example_url'=>'http://www.techport.ru/katalog/products/santehnika/vanny/akrilovye/riho-miami-180x80x49-bb6400500000000',
            ],
            */



            //http://1san.ru/id/dushevaya-kabina-niagara-120x80-ng-510-r-l-19407.html
            [
                'type_id'=>2,
                'name'=>'Список товаров на 1san.ru',
                'reg_exp'=>'(?!^http[s]?://.*1san.ru/page/.*html$)(?!^http[s]?://.*1san.ru/id/.*html$)(^http[s]?://.*1san.ru/.*html$)',
                'example_url'=>'https://1san.ru/dushevyekabiny.html',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на 1san.ru',
                'reg_exp'=>'(^http[s]?://.*1san.ru/id/.*html$)',
                'example_url'=>'http://1san.ru/id/dushevaya-kabina-niagara-120x80-ng-510-r-l-19407.html',
            ],

            //vannamoskva.ru
            [
                'type_id'=>2,
                'name'=>'Список товаров на vannamoskva.ru',
                'reg_exp'=>'(^http[s]?://.*vannamoskva.ru/catalog/.*$)',
                'example_url'=>'https://vannamoskva.ru/catalog/hansgrohe',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на vannamoskva.ru',
                'reg_exp'=>'(^http[s]?://.*vannamoskva.ru/products/.*$)',
                'example_url'=>'https://vannamoskva.ru/products/smesitel-dlya-kuhni-grohe-blue-dlya-vodoprovodnoj-i-filtrovannoj-vody-123375-33251-000-',
            ],

            //http://deltasan.ru/catalog/shower-stalls/dushevaya-kabina-niagara-ng-1509-2509-bez-gidromassazha/
            /*
            [
                'type_id'=>2,
                'name'=>'Список товаров на deltasan.ru',
                'reg_exp'=>'(^http[s]?://.*deltasan.ru/catalog/.*$)',
                'example_url'=>'http://deltasan.ru/catalog/dushevye-poddony/nizkiy-dushevoy-poddon/',
            ],
            [
                'type_id'=>1,
                'name'=>'Карточка товара на deltasan.ru',
                'reg_exp'=>'(^http[s]?://.*deltasan.ru/products/.*$)',
                'example_url'=>'http://deltasan.ru/catalog/shower-stalls/dushevye-kabiny-chetvert-kruga/dushevaya-kabina-river-nara-b-k-80-26-mt-matovoe-steklo/',
            ],
            */

            //https://www.m-vanna.ru/catalog/products/gidromassazhnye-boksy/dushevaja-kabina-niagara-ng-1509
            //ceramicplus.ru
            //http://www.suntechnica.ru/dushevaya-kabina-niagara-ng-1310-rl/
            //https://www.mirsanteh.ru/catalog/kabiny/dushevaja_kabina_niagara_ng-13102310_levajapravaja.html
            //gidro-top.ru
            //http://www.akvita.ru/catalog/dushevye_kabiny/?id=7413
            //premium-v.ru
            //http://qq.ru/product/00000091688/
            //aquavil.ru
            //http://santeh-diler.ru/product/dushevaya-kabina-niagara-ng-510
            //http://grinc.ru/dushevye-kabiny/s-gidromassazhem/niagara-ng-510/
            //http://perl-santehnika.ru/dushevye-kabiny/dushevye-kabiny-s-nizkim-poddonom-652/dushevaya-kabina-river-rein-90-26-mt
            //http://www.santeh-opt.ru/tovar.php?nmb=21813
            //http://sangold.ru/index.php?productID=9580
            //http://www.xn----7sbbfc1cngam7a2i.xn--p1ai/product/dushevaja-kabina-niagara-ng-309-01n/
            //http://santehstok.ru/shop/7207/desc/dushevaja-kabina-niagara-niagara-ng-510
            //Santehnika47.ru
            //vanna-doma.ru
            //aqualetto-markon.ru
            //santut.ru
            //http://spa.com.ru/item.php?id=5448
            //https://axor.su/item/dushevaya_kabina_niagara_ng_2310/
            //http://mir-wan.ru/tov/41747/niagara_ng-309/
            //http://www.santekhnika.ru/dushevaya-kabina-niagara-ng-510.html
            //santeh-centr.ru
            //http://san-mag.ru/dushevaya-kabina-niagara-ng-2310-r/
            //bathsale.ru
            //http://hit-vanna.ru/dushevye-kabiny-boksy-gidromassazhye/dushevye-kabiny-asimmetrichnye-kupit-ceny-razmery/dushevaja-kabina-niagara-ng-1310-r-uglovaja.html

        ];
    }

}
