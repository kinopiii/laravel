<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use Carbon\Carbon;

class AddcategorySeeder extends Seeder
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
        'id' => 6,
        'name' => '健康器具',
        'created_at' => Carbon::now()
      ],
      [
        'id' => 7,
        'name' => '文房具',
        'created_at' => Carbon::now()
      ],
      [
        'id' => 8,
        'name' => 'おもちゃ',
        'created_at' => Carbon::now()
      ],
      [
        'id' => 9,
        'name' => '車',
        'created_at' => Carbon::now()
      ],
      [
        'id' => 10,
        'name' => 'ジュエリー',
        'created_at' => Carbon::now()
      ],
      [
        'id' => 12,
        'name' => '日用品',
        'created_at' => Carbon::now()
      ],
      [
        'id' => 13,
        'name' => 'PC周辺機器',
        'created_at' => Carbon::now()
      ],
      [
        'id' => 14,
        'name' => 'キッチン用品',
        'created_at' => Carbon::now()
      ],
      [
        'id' => 15,
        'name' => '腕時計',
        'created_at' => Carbon::now()
      ],
      [
        'id' => 16,
        'name' => '楽器',
        'created_at' => Carbon::now()
      ],
      [
        'id' => 17,
        'name' => 'スポーツ用品',
        'created_at' => Carbon::now()
      ],
      [
        'id' => 18,
        'name' => 'ダイエット用品',
        'created_at' => Carbon::now()
      ],
      [
        'id' => 19,
        'name' => 'バイク',
        'created_at' => Carbon::now()
      ],
      [
        'id' => 20,
        'name' => '工具・DIY',
        'created_at' => Carbon::now()
      ],
      [
        'id' => 21,
        'name' => 'ペット用品',
        'created_at' => Carbon::now()
      ],
     ]);
    }
}
