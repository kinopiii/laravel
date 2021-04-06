<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class ProductCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categorys', function (Blueprint $table) {
            $table->increments('id')->comment('カテゴリID');;
            $table->string('name',255)->comment('カテゴリ名');
            NestedSet::columns($table);
            $table->timestamps();//->comment('登録日時');
            //$table->timestamps('updated_at')->comment('編集日時');
            $table->softDeletes()->nullable()->comment('削除日時');
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_categories');    
    }
}
