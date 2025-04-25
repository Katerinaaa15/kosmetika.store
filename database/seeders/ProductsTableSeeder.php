<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [ 
                'name'=>'Retinols 10ml.',
                'code'=>'retinol',
                'description'=>'Spēcīgs aktīvais komponents, kas veicina ādas atjaunošanos un samazina grumbas',
                'price'=>'5.00',
                'category_id'=>1,
                'image'=>'products/retinol.jpg',

            ],

            [
                'name'=>'Hiauloronskābe 10ml.',
                'code'=>'hiauloron_skabe',
                'description'=>'Intensīvi mitrina ādu, palīdzot tai izskatīties svaigai un elastīgai',
                'price'=>'7.85',
                'category_id'=>1,
                'image'=>'products/hiauluronskabe.jpg',
            ],

            [
                'name'=>'Vitamīns C 10mg.',
                'code'=>'vitamins_c',
                'description'=>'Spēcīgs antioksidants, kas izgaismo ādu un samazina pigmentācijas plankumus',
                'price'=>'4.89',
                'category_id'=>1,
                'image'=>'products/vitamins_C',
            ],

            [
                'name'=>'Augļskābes 70% 30ml.',
                'code'=>'aug_skabes',
                'description'=>'Piemīt viegla pīlinga iedarbība, noloba atmirušās šūnas un uzlabo ādas tekstūru',
                'price'=>'10.50',
                'category_id'=>1,
                'image'=>'products/aha_skabes.jpg',
            ],


            [
                'name'=>'Kolagēns 10ml.',
                'code'=>'kolagens',
                'description'=>'Uzlabo ādas elastību un nostiprina ādas struktūru',
                'price'=>'8.80',
                'category_id'=>1,
                'image'=>'products/kolagens.jpg',
            ],


            [
                'name'=>'Kokosriekstu eļļa 100gr.',
                'code'=>'kokos_oil',
                'description'=>'Universāla eļļa ar mitrinošām un antibakteriālām īpašībām',
                'price'=>'10.99',
                'category_id'=>2,
                'image'=>'products/kokos_ella.jpg',
            ],


            [
                'name'=>'Makadamijas eļļa 100gr.',
                'code'=>'makadam_oil',
                'description'=>'Baro un mīkstina ādu, īpaši piemērota sausai ādai',
                'price'=>'12.60',
                'category_id'=>2,
                'image'=>'products/makadamijas_ella',
            ],

            [
                'name'=>'Aprikožu eļļa 100gr.',
                'code'=>'aprikozu_oil',
                'description'=>'Vieglā tekstūra padara to ideālu jutīgai un sausai ādai',
                'price'=>'12.50',
                'category_id'=>2,
                'image'=>'products/aprikozu_ella',
            ],



            [
                'name'=>'Vīnogu kauliņu eļļa 100gr.',
                'code'=>'vinogu_kaul_oil',
                'description'=>'Viegls, mitrinošs eļļas veids ar antioksidantu iedarbību',
                'price'=>'8.80',
                'category_id'=>2,
                'image'=>'products/vinogu_kaulinu_ella',
            ],


            [
                'name'=>'Olivem 20gr.',
                'code'=>'olivem',
                'description'=>'Dabīgs emulgators no olīveļļas, veido stabilas emulsijas ar patīkamu tekstūru',
                'price'=>'6.70',
                'category_id'=>3,
                'image'=>'products/olivem.jpg',
            ],

            [
                'name'=>'Lamegel 10gr.',
                'code'=>'lamegel',
                'description'=>'Gēlveida struktūru veidojošs emulgators ar mitrinošu efektu',
                'price'=>'5.90',
                'category_id'=>3,
                'image'=>'products/lamegel.jpg',
            ],

            [
                'name'=>'Guara svēķi',
                'code'=>'guara_gum',
                'description'=>'Dabīgs biezinātājs un stabilizators emulsijām un želejām',
                'price'=>'4.60',
                'category_id'=>3,
                'image'=>'products/guara_sveki.jpg',
            ],

            [
                'name'=>'Coco-glucoside 0,5l.',
                'code'=>'coco_glucoside',
                'description'=>'Maigs virsmaktīvais līdzeklis no kokosrieksta eļļas un glikozes',
                'price'=>'10.50',
                'category_id'=>4,
                'image'=>'products/coco_gluco.jpg',
            ],

            [
                'name'=>'Ananasu enzīmi 20gr.',
                'code'=>'ananasu_enzimi',
                'description'=>'Dabisks pīlings, kas palīdz noņemt atmirušās ādas šūnas un izgaismo ādu',
                'price'=>'7.90',
                'category_id'=>4,
                'image'=>'products/bromelain.jpg',
            ],

            [
                'name'=>'Luryl-glucoside 0,5l.',
                'code'=>'luryl_glucoside',
                'description'=>'Ļoti maigs putotājs, piemērots jutīgas ādas un bērnu produktiem',
                'price'=>'12.50',
                'category_id'=>4,
                'image'=>'products/lauryl_gluco.jpg',
            ],


            [
                'name'=>'Betaine 0,5l.',
                'code'=>'betaine',
                'description'=>'Mitrinoša viela ar nomierinošu un ādu aizsargājošu iedarbību',
                'price'=>'9.5',
                'category_id'=>4,
                'image'=>'products/betaine.jpg',
            ],
        ]);
    }
}
