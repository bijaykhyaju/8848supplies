<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('alias');
            $table->text('description')->nullable();
            $table->integer('cat_id')->unsigned();
            $table->string('image')->nullable();
            $table->decimal('mark_price',10, 2)->nullable();
            $table->decimal('actual_price',10, 2);
            $table->integer('stock_qnt')->unsigned()->nullable();
            $table->integer('max_order_qnt')->unsigned()->nullable();
            $table->integer('grp_qnt1')->unsigned()->nullable();
            $table->decimal('grp_qnt1_price',10, 2)->nullable();
            $table->integer('grp_qnt2')->unsigned()->nullable();
            $table->decimal('grp_qnt2_price',10, 2)->nullable();
            $table->integer('grp_qnt3')->unsigned()->nullable();
            $table->decimal('grp_qnt3_price',10, 2)->nullable();
            $table->integer('order')->unsigned()->default(1);
            $table->boolean('publish')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
