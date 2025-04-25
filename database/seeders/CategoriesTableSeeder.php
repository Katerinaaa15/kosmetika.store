<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->truncate();
        DB::table('categories')->insert([
            ['name'=>'Aktīvās izējvielas', 'code'=>'aktivi', 'description'=>'Aktīvas sastavdaļas kosmētikas izgatavošanai.', 'image'=>'categories/virsmas_vielas.jpg'],
            ['name'=>'Eļļas', 'code'=>'ellas', 'description'=>'Mikstina un baro ādu.', 'image'=>'categories/oils.jpg'],
            ['name'=>'Emulgatori', 'code'=>'emulgatori', 'description'=>'Palīdz sajaukt ūdeni un eļļas, veidojot vienotu kosmētisko emulsiju.','image'=>'categories/emulgatori.jpg'],
            ['name'=>'Virsmas aktīvās vielas', 'code'=>'vav', 'description'=>'Tīrīšanas līdzekļu sastāvdaļas, kas palīdz noņemt netīrumus un taukus.', 'image'=>'categories/aktivas_izejas.jpg'],
        ]);
    }
}
