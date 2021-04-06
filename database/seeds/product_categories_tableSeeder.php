<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class product_categories_tableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

public function run()
   {
      DB::table('product_categorys')->insert([
       [
         'id' => 1,
         'name' => 'インテリア',
       ],
       [
         'id' => 2,
         'name' => '家電',
       ],
       [
         'id' => 3,
         'name' => 'ファッション',
       ],
       [
         'id' => 4,
         'name' => '美容',
       ],
       [
         'id' => 5,
         'name' => '本・雑誌',
       ]
      ]);

     DB::table('product_subcategorys')->insert([
       [
         'id' => 1,
         'product_category_id' => 1,
         'name' => '収納家具',
       ],
       [
         'id' => 2,
         'product_category_id' => 1,
         'name' => '寝具',
       ],
       [
         'id' => 3,
         'product_category_id' => 1,
         'name' => 'ソファ',
       ],
       [
         'id' => 4,
         'product_category_id' => 1,
         'name' => 'ベッド',
       ],
       [
         'id' => 5,
         'product_category_id' => 1,
         'name' => '証明',
       ],
       [
         'id' => 6,
         'product_category_id' => 2,
         'name' => 'テレビ',
       ],
       [
         'id' => 7,
         'product_category_id' => 2,
         'name' => '掃除機',
       ],
       [
         'id' => 8,
         'product_category_id' => 2,
         'name' => 'エアコン',
       ],
       [
         'id' => 9,
         'product_category_id' => 2,
         'name' => '冷蔵庫',
       ],
       [
         'id' => 10,
         'product_category_id' => 2,
         'name' => 'レンジ',
       ],
       [
         'id' => 11,
         'product_category_id' => 3,
         'name' => 'トップス',
       ],
       [
         'id' => 12,
         'product_category_id' => 3,
         'name' => 'ボトム',
       ],
       [
         'id' => 13,
         'product_category_id' => 3,
         'name' => 'ワンピース',
       ],
       [
         'id' => 14,
         'product_category_id' => 3,
         'name' => 'ファッション小物',
       ],
       [
         'id' => 15,
         'product_category_id' => 3,
         'name' => 'ドレス',
       ],
       [
         'id' => 16,
         'product_category_id' => 4,
         'name' => 'ネイル',
       ],
       [
         'id' => 17,
         'product_category_id' => 4,
         'name' => 'アロマ',
       ],
       [
         'id' => 18,
         'product_category_id' => 4,
         'name' => 'スキンケア',
       ],
       [
         'id' => 19,
         'product_category_id' => 4,
         'name' => '香水',
       ],
       [
         'id' => 20,
         'product_category_id' => 4,
         'name' => 'メイク',
       ],
       [
         'id' => 21,
         'product_category_id' => 5,
         'name' => '旅行',
       ],
       [
         'id' => 22,
         'product_category_id' => 5,
         'name' => 'ホビー',
       ],
       [
         'id' => 23,
         'product_category_id' => 5,
         'name' => '写真集',
       ],
       [
         'id' => 24,
         'product_category_id' => 5,
         'name' => '小説',
       ],
       [
         'id' => 25,
         'product_category_id' => 5,
         'name' => 'ライフスタイル',
       ]
      ]);

   }
}
