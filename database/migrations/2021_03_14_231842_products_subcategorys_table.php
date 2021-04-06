<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductsSubcategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_subcategorys', function (Blueprint $table) {
            $table->increments('id')->comment('サブカテゴリID');;
            $table->integer('product_category_id')->comment('カテゴリ名');
            $table->string('name', 255)->comment('サブカテゴリ名');
            $table->timestamps();
            $table->softDeletes()->comment('削除日時');
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
