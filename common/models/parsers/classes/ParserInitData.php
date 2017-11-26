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
                'type_id'=>1,
                'name'=>'dushevoi.ru',
                'reg_exp'=>'(^https?://.*dushevoi.ru/products/)',
                'example_url'=>'https://www.dushevoi.ru/products/dushevye-kabiny/',
            ],
            
            //santehnika-online.ru
            [
                'type_id'=>1,
                'name'=>'santehnika-online.ru',
                'reg_exp'=>'(^https?://[\w.]*santehnika-online.ru/.*$)',
                'example_url'=>'https://santehnika-online.ru/vanny/stalnye/',
            ],

            //center-santehniki.ru
            [
                'type_id'=>1,
                'name'=>'center-santehniki.ru',
                'reg_exp'=>'(?!^.*html$)(^http[s]?://[\w.]*center-santehniki.ru/catalog/)',
                'example_url'=>'https://center-santehniki.ru/catalog/vanny/akrilovye/',
            ],

            //center-santehniki.ru
            [
                'type_id'=>1,
                'name'=>'djakudza.ru',
                'reg_exp'=>'(^https?://.*djakudza.ru/category/)',
                'example_url'=>'http://www.djakudza.ru/category/dushevye-kabiny/',
            ],

            //aquatika.ru
            [
                'type_id'=>1,
                'name'=>'aquatika.ru',
                'reg_exp'=>'(^https?://.*aquatika.ru/prods_.*html$)',
                'example_url'=>'http://www.aquatika.ru/prods_radius.html',
            ],

            //http://santehnika-tut.ru/k23635.html
            [
                'type_id'=>1,
                'name'=>'santehnika-tut.ru',
                'reg_exp'=>'(^https?://[\w.]*santehnika-tut.ru/)',
                'example_url'=>'http://santehnika-tut.ru/dushevye-kabiny/',
            ],

            //https://www.santehgorod.ru/catalog/kabiny/river_rein_9026_mt.html
            [
                'type_id'=>1,
                'name'=>'santehgorod.ru',
                'reg_exp'=>'(^https?://[\w.]*santehgorod.ru/catalog/)',
                'example_url'=>'https://www.santehgorod.ru/catalog/kabiny/',
            ],
            
            //http://www.aquadom.ru/dushevie_kabini_boksi/dushevaya_kabina_niagara_ng_510_bez_bani/
            
            [
                'type_id'=>1,
                'name'=>'aquadom.ru',
                'reg_exp'=>'(^https?://.*aquadom.ru)',
                'example_url'=>'http://www.aquadom.ru/rakovini/',
            ],

            //dlyavann.ru
            [
                'type_id'=>1,
                'name'=>'dlyavann.ru',
                'reg_exp'=>'(^http[s]?://[\w.]*dlyavann.ru/.*html$)',
                'example_url'=>'http://www.dlyavann.ru/category/unitazy.html',
            ],
            

            //perfekto.ru
            [
                'type_id'=>1,
                'name'=>'perfekto.ru',
                'reg_exp'=>'(^https?://.*perfekto.ru/catalog)',
                'example_url'=>'https://www.perfekto.ru/catalog/unitazy/unitaz_artic_4310_gb114310301737_gb114310301231/',
            ],

            //sanone.ru
            [
                'type_id'=>1,
                'name'=>'sanone.ru',
                'reg_exp'=>'(^https?://.*sanone.ru/.*$)',
                'example_url'=>'http://sanone.ru/mebel_dlya_vannoy/alta-marea-atollo-komplekt-mebeli.html',
            ],

            //https://www.santehnika-room.ru/dushevye-kabiny/assimetrichnye/dushevaya-kabina-niagara-ng-2310r-ng-2310r
            [
                'type_id'=>1,
                'name'=>'santehnika-room',
                'reg_exp'=>'(^http[s]?://[\w.]*santehnika-room.ru/)',
                'example_url'=>'https://www.santehnika-room.ru/unitazy/napolnye',
            ],
            

            //santehtop.ru
            [
                'type_id'=>1,
                'name'=>'santehtop.ru',
                'reg_exp'=>'(^http[s]?://[\w.]*santehtop.ru/)',
                'example_url'=>'http://www.santehtop.ru/vanny/akrilovie/aquatika/',
            ],

            //sanberry.ru
            [
                'type_id'=>1,
                'name'=>'sanberry.ru',
                'reg_exp'=>'(^http[s]?://[\w.]*sanberry.ru/)',
                'example_url'=>'http://sanberry.ru/catalog/sanfayans/unitazy/',
            ],

            //http://santeh-era.ru/catalog/dushevye_kabiny_bez_para/dushevaya_kabina_niagara_ng_2310r/
            [
                'type_id'=>1,
                'name'=>'santeh-era.ru',
                'reg_exp'=>'(^http[s]?://[\w.]*santeh-era.ru/)',
                'example_url'=>'http://santeh-era.ru/catalog/vanny_chugunnye/',
            ],

            //https://sdvk.ru/Dushevie_kabini/niagara-ng-2310-group/
            [
                'type_id'=>1,
                'name'=>'sdvk.ru',
                'reg_exp'=>'(^http[s]?://[\w.]*sdvk.ru/)',
                'example_url'=>'https://sdvk.ru/Dushevie_kabini/Niagara/',
            ],

            //http://www.santehnica.ru/product/64140.html
            [
                'type_id'=>1,
                'name'=>'santehnica.ru',
                'reg_exp'=>'(^http[s]?://[\w.]*santehnica.ru/)',
                'example_url'=>'http://www.santehnica.ru/catalog/dushevie-kabini/niagara/',
            ],

            //https://wodolei.ru/catalog/dushevie_kabini/niagara-ng-2310-r-101016-item/
            [
                'type_id'=>1,
                'name'=>'wodolei.ru',
                'reg_exp'=>'(^http[s]?://[\w.]*wodolei.ru/catalog/)',
                'example_url'=>'https://wodolei.ru/catalog/dushevie_kabini/Niagara/',
            ],

            //https://www.santeh-import.ru/Dushevaya-kabina-River-Rein-90x90x210-REIN-9026-kupit-goods_190442.html?d=190430
            [
                'type_id'=>1,
                'name'=>'santeh-import.ru',
                'reg_exp'=>'(^http[s]?://.*santeh-import.ru.*html$)',
                'example_url'=>'https://www.santeh-import.ru/Vanny-Vanny-pryamougolnye%2C-kvadratnye-kupit-category_438-b0.html',
            ],

            //http://santeh-mag.com/katalog/dushevye-kabiny/dushevaya-kabina-river-rein-90-26-mt/?sphrase_id=21332
            [
                'type_id'=>1,
                'name'=>'santeh-magt.ru',
                'reg_exp'=>'(^http[s]?://.*santeh-mag.com/katalog/)',
                'example_url'=>'http://santeh-mag.com/katalog/dushevye-boksy/',
            ],

            //http://www.techport.ru/katalog/products/santehnika/dushevye-kabiny/dushevaja-kabina-niagara-ng-510-421463
            [
                'type_id'=>1,
                'name'=>'techport.ru',
                'reg_exp'=>'(^http[s]?://.*techport.ru/katalog/.*$)',
                'example_url'=>'http://www.techport.ru/katalog/products/santehnika/vanny',
            ],



            //http://1san.ru/id/dushevaya-kabina-niagara-120x80-ng-510-r-l-19407.html
            [
                'type_id'=>1,
                'name'=>'1san.ru',
                'reg_exp'=>'(^http[s]?://.*1san.ru/.*html$)',
                'example_url'=>'https://1san.ru/dushevyekabiny.html',
            ],

            //vannamoskva.ru
            [
                'type_id'=>1,
                'name'=>'vannamoskva.ru',
                'reg_exp'=>'(^http[s]?://.*vannamoskva.ru/.*$)',
                'example_url'=>'https://vannamoskva.ru/catalog/hansgrohe',
            ],

            //http://deltasan.ru/catalog/shower-stalls/dushevaya-kabina-niagara-ng-1509-2509-bez-gidromassazha/
            [
                'type_id'=>1,
                'name'=>'deltasan.ru',
                'reg_exp'=>'(^http[s]?://.*deltasan.ru/catalog/.*$)',
                'example_url'=>'http://deltasan.ru/catalog/dushevye-poddony/nizkiy-dushevoy-poddon/',
            ],
            
            //https://www.m-vanna.ru/catalog/products/gidromassazhnye-boksy/dushevaja-kabina-niagara-ng-1509
            [
                'type_id'=>1,
                'name'=>'m-vanna.ru',
                'reg_exp'=>'(^http[s]?://.*m-vanna.ru/catalog/products/.*$)',
                'example_url'=>'https://www.m-vanna.ru/catalog/products/gidromassazhnye-boksy/dushevaja-kabina-niagara-ng-1509',
            ],

            //ceramicplus.ru
            [
                'type_id'=>1,
                'name'=>'ceramicplus.ru',
                'reg_exp'=>'(^http[s]?://.*ceramicplus.ru/catalog/.*$)',
                'example_url'=>'https://www.ceramicplus.ru/catalog/dushi/dushevyje_garnitury',
            ],

            //http://www.suntechnica.ru/dushevaya-kabina-niagara-ng-1310-rl/
            [
                'type_id'=>1,
                'name'=>'suntechnica.ru',
                'reg_exp'=>'(^http[s]?://.*suntechnica.*$)',
                'example_url'=>'http://www.suntechnica.ru/dushevaya-kabina-niagara-ng-1310-rl/',
            ],

            //https://www.mirsanteh.ru/catalog/kabiny/dushevaja_kabina_niagara_ng-13102310_levajapravaja.html
            [
                'type_id'=>1,
                'name'=>'suntechnica.ru',
                'reg_exp'=>'(^http[s]?://.*mirsanteh.ru/catalog/.*$)',
                'example_url'=>'https://www.mirsanteh.ru/catalog/kabiny/dushevaja_kabina_niagara_ng-13102310_levajapravaja.html',
            ],

            //gidro-top.ru
            [
                'type_id'=>1,
                'name'=>'gidro-top.ru',
                'reg_exp'=>'(^http[s]?://.*gidro-top.ru/product/.*$)|(^http[s]?://.*gidro-top.ru/category/.*$)',
                'example_url'=>'http://gidro-top.ru/product/viega-704353-advantix-vario-set/',
            ],

            //http://www.akvita.ru/catalog/dushevye_kabiny/?id=7413
            [
                'type_id'=>1,
                'name'=>'akvita.ru',
                'reg_exp'=>'(^http[s]?://.*akvita.ru/catalog/.*$)',
                'example_url'=>'http://www.akvita.ru/catalog/dushevye_kabiny/?id=7413',
            ],

            //premium-v.ru
            [
                'type_id'=>1,
                'name'=>'premium-v.ru',
                'reg_exp'=>'(^http[s]?://.*premium-v.ru/products/.*$)',
                'example_url'=>'https://www.premium-v.ru/products/recor_classic_170x75.html',
            ],

            //http://qq.ru/product/00000091688/
            [
                'type_id'=>1,
                'name'=>'premium-v.ru',
                'reg_exp'=>'(^http[s]?://.*qq.ru/product/.*$)|(^http[s]?://.*qq.ru/category/.*$)',
                'example_url'=>'http://qq.ru/product/00000091688/',
            ],

            //aquavil.ru
            [
                'type_id'=>1,
                'name'=>'aquavil.ru',
                'reg_exp'=>'(^http[s]?://.*aquavil.ru/catalog/.*$)',
                'example_url'=>'https://aquavil.ru/catalog/baths/square/vanna_relisan_marina_170h75/',
            ],

            //http://santeh-diler.ru/product/dushevaya-kabina-niagara-ng-510
            [
                'type_id'=>1,
                'name'=>'santeh-diler.ru',
                'reg_exp'=>'(^http[s]?://.*santeh-diler.ru/product/.*$)|(^http[s]?://.*santeh-diler.ru/category/.*$)',
                'example_url'=>'http://santeh-diler.ru/product/dushevaya-kabina-niagara-ng-510',
            ],

            //http://grinc.ru/dushevye-kabiny/s-gidromassazhem/niagara-ng-510/
            [
                'type_id'=>1,
                'name'=>'grinc.ru',
                'reg_exp'=>'(^http[s]?://.*grinc.ru/.*$)',
                'example_url'=>'http://grinc.ru/dushevye-kabiny/s-gidromassazhem/niagara-ng-510/',
            ],

            //http://perl-santehnika.ru/dushevye-kabiny/dushevye-kabiny-s-nizkim-poddonom-652/dushevaya-kabina-river-rein-90-26-mt
            [
                'type_id'=>1,
                'name'=>'perl-santehnika.ru',
                'reg_exp'=>'(^http[s]?://.*perl-santehnika.ru/.*$)',
                'example_url'=>'http://perl-santehnika.ru/dushevye-kabiny/dushevye-kabiny-s-nizkim-poddonom-652/dushevaya-kabina-river-rein-90-26-mt',
            ],

            //http://www.santeh-opt.ru/tovar.php?nmb=21813
            [
                'type_id'=>1,
                'name'=>'santeh-opt.ru',
                'reg_exp'=>'(^http[s]?://.*santeh-opt.ru/.*$)',
                'example_url'=>'http://www.santeh-opt.ru/tovar.php?nmb=21813',
            ],

            //http://sangold.ru/index.php?productID=9580
            [
                'type_id'=>1,
                'name'=>'sangold.ru',
                'reg_exp'=>'(^http[s]?://.*sangold.ru/.*$)',
                'example_url'=>'http://sangold.ru/index.php?productID=9580',
            ],


            //http://santehstok.ru/shop/7207/desc/dushevaja-kabina-niagara-niagara-ng-510
            [
                'type_id'=>1,
                'name'=>'santehstok.ru',
                'reg_exp'=>'(^http[s]?://.*santehstok.ru/shop/.*$)',
                'example_url'=>'http://santehstok.ru/shop/7207/desc/dushevaja-kabina-niagara-niagara-ng-510',
            ],

            //Santehnika47.ru
            [
                'type_id'=>1,
                'name'=>'santehnika47.ru',
                'reg_exp'=>'(^http[s]?://.*santehnika47.ru/.*$)',
                'example_url'=>'http://santehstok.ru/shop/7207/desc/dushevaja-kabina-niagara-niagara-ng-510',
            ],
            
            //vanna-doma.ru
            [
                'type_id'=>1,
                'name'=>'vanna-doma.ru',
                'reg_exp'=>'(^http[s]?://.*vanna-doma.ru/shop/.*$)',
                'example_url'=>'https://www.vanna-doma.ru/shop/Smesiteli/s_gigienicheskim_dushem/Cezares_GARDA-ID-01_gigienicheskiy_dush-9809.html',
            ],

            //aqualetto-markon.ru
            [
                'type_id'=>1,
                'name'=>'aqualetto-markon.ru',
                'reg_exp'=>'(^http[s]?://.*aqualetto-markon.ru/.*id_kat.*(id_tov)?.*$)',
                'example_url'=>'http://www.aqualetto-markon.ru/index.php?id_kat=24&id_tov=211',
            ],

            //santut.ru
            [
                'type_id'=>1,
                'name'=>'santut.ru',
                'reg_exp'=>'(^http[s]?://.*santut.ru/.*/.*(product_id)?.*$)',
                'example_url'=>'https://santut.ru/dushevye-kabiny-gidroboksy/dushevye-ugli?product_id=1557',
            ],

            //http://spa.com.ru/item.php?id=5448
            [
                'type_id'=>1,
                'name'=>'spa.com.ru',
                'reg_exp'=>'(^http[s]?://.*spa.com.ru/.*(sid=|id=)+.*$)',
                'example_url'=>'http://spa.com.ru/bathsdetail.php?id=2927&sid=292&l_from=120&l_to=140',
            ],

            //https://axor.su/item/dushevaya_kabina_niagara_ng_2310/
            [
                'type_id'=>1,
                'name'=>'axor.su',
                'reg_exp'=>'(^http[s]?://.*axor.su.*$)',
                'example_url'=>'https://axor.su/item/dushevaya_kabina_luxus_895/',
            ],

            //http://mir-wan.ru/tov/41747/niagara_ng-309/
            [
                'type_id'=>1,
                'name'=>'mir-wan.ru',
                'reg_exp'=>'(^http[s]?://.*mir-wan.ru.*(sub|tov)+.*$)',
                'example_url'=>'http://mir-wan.ru/tov/41747/niagara_ng-309/',
            ],

            //http://www.santekhnika.ru/dushevaya-kabina-niagara-ng-510.html
            [
                'type_id'=>1,
                'name'=>'santekhnika.ru',
                'reg_exp'=>'(^http[s]?://.*santekhnika.ru/.*$)',
                'example_url'=>'http://www.santekhnika.ru/dushevaya-kabina-niagara-ng-510.html',
            ],

            //santeh-centr.ru
            [
                'type_id'=>1,
                'name'=>'santeh-centr.ru',
                'reg_exp'=>'(^http[s]?://.*santeh-centr.ru/.*$)',
                'example_url'=>'https://santeh-centr.ru/dushevye-kabiny-gidroboksy/dushevye-kabiny/dushevaja-kabina-ammari-am-082-80-8080215-sm-bez-gidromassazha',
            ],

            //http://san-mag.ru/dushevaya-kabina-niagara-ng-2310-r/
            [
                'type_id'=>1,
                'name'=>'san-mag.ru',
                'reg_exp'=>'(^http[s]?://.*san-mag.ru/.*$)',
                'example_url'=>'http://san-mag.ru/dushevaya-kabina-niagara-ng-2310-r/',
            ],

            //bathsale.ru
            [
                'type_id'=>1,
                'name'=>'bathsale.ru',
                'reg_exp'=>'(^http[s]?://.*bathsale.ru/katalog-produkczii/.*$)',
                'example_url'=>'https://bathsale.ru/katalog-produkczii/dushevyie-kabinyi/slivnyie-trapyi/dushevoj-boks-frank-f555-140/85-sm.html',
            ],

            //http://hit-vanna.ru/dushevye-kabiny-boksy-gidromassazhye/dushevye-kabiny-asimmetrichnye-kupit-ceny-razmery/dushevaja-kabina-niagara-ng-1310-r-uglovaja.html
            [
                'type_id'=>1,
                'name'=>'hit-vanna.ru',
                'reg_exp'=>'(^http[s]?://.*hit-vanna.ru/.*$)',
                'example_url'=>'http://hit-vanna.ru/dushevye-kabiny-boksy-gidromassazhye/dushevye-kabiny-asimmetrichnye-kupit-ceny-razmery/dushevaja-kabina-niagara-ng-1310-r-uglovaja.html',
            ],

            //http://hunting4all.ru/
            [
                'type_id'=>1,
                'name'=>'hunting4all.ru',
                'reg_exp'=>'(^http[s]?://.*hunting4all.ru/.*$)',
                'example_url'=>'http://hunting4all.ru/',
            ],

            //https://kwork.ru/land/parser-dlya-sayta
            [
                'type_id'=>1,
                'name'=>'parser-dlya-sayta.ru',
                'reg_exp'=>'(^http[s]?://.*kwork.ru/land/parser-dlya-sayta.*$)',
                'example_url'=>'https://kwork.ru/land/parser-dlya-sayta',
            ],

            //http://merida.ru/tovary
            [
                'type_id'=>1,
                'name'=>'merida.ru',
                'reg_exp'=>'(^http[s]?://.*merida.ru/tovary.*$)',
                'example_url'=>'http://merida.ru/tovary',
            ],

            //http://vkak.deer.io/
            [
                'type_id'=>1,
                'name'=>'vkak.deer.io',
                'reg_exp'=>'(^http[s]?://.*vkak.deer.io.*$)',
                'example_url'=>'http://vkak.deer.io/',
            ],
            
            //http://foodmarkets.ru/users
            [
                'type_id'=>2,
                'name'=>'foodmarkets.ru',
                'reg_exp'=>'(^http[s]?://.*foodmarkets.ru/users.*$)',
                'example_url'=>'http://foodmarkets.ru/users',
            ],

            //https://www.sportmaster.ru/catalog/begovye_lyzhi/lyzhi/
            [
                'type_id'=>1,
                'name'=>'sportmaster.ru',
                'reg_exp'=>'(^http[s]?://.*sportmaster.ru/(catalog|product).*$)',
                'example_url'=>'https://www.sportmaster.ru/catalog/begovye_lyzhi/lyzhi/',
            ],

        ];
    }

}
