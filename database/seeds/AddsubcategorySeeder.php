<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AddsubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_subcategorys')->insert([
            [
              'id' => 37,
              'product_category_id' => 6,
              'name' => 'ぶら下がり棒',
              'created_at' => Carbon::now()
            ],
            [
              'id' => 38,
              'product_category_id' => 7,
              'name' => 'ボールペン',
              'created_at' => Carbon::now()
            ],
            [
              'id' => 39,
              'product_category_id' => 8,
              'name' => '子供用',
              'created_at' => Carbon::now()
            ],
            [
              'id' => 40,
              'product_category_id' => 9,
              'name' => '外車',
              'created_at' => Carbon::now()
            ],
            [
              'id' => 41,
              'product_category_id' => 10,
              'name' => 'ゴールド',
              'created_at' => Carbon::now()
            ],
            [
              'id' => 42,
              'product_category_id' => 12,
              'name' => 'ティッシュ',
              'created_at' => Carbon::now()
            ],
            [
              'id' => 43,
              'product_category_id' => 13,
              'name' => 'マウス',
              'created_at' => Carbon::now()
            ],
            [
              'id' => 44,
              'product_category_id' => 14,
              'name' => 'お皿',
              'created_at' => Carbon::now()
            ],
            [
              'id' => 45,
              'product_category_id' => 15,
              'name' => '女性用',
              'created_at' => Carbon::now()
            ],
            [
              'id' => 46,
              'product_category_id' => 16,
              'name' => 'ピアノ',
              'created_at' => Carbon::now()
            ],
            [
              'id' => 47,
              'product_category_id' => 17,
              'name' => '野球',
              'created_at' => Carbon::now()
            ],
            [
              'id' => 48,
              'product_category_id' => 18,
              'name' => 'EMS',
              'created_at' => Carbon::now()
            ],
            [
              'id' => 49,
              'product_category_id' => 19,
              'name' => '大型車',
              'created_at' => Carbon::now()
            ],
            [
              'id' => 50,
              'product_category_id' => 20,
              'name' => '小物',
              'created_at' => Carbon::now()
            ],
            [
              'id' => 51,
              'product_category_id' => 21,
              'name' => 'ペットシーツ',
              'created_at' => Carbon::now()
            ]
           ]);
    }
}
