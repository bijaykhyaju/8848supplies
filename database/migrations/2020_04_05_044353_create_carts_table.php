<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id')->unsigned();
            $table->string('session_id');
            $table->decimal('mark_price',10, 2)->nullable();
            $table->decimal('selling_price',10, 2);
            $table->integer('cart_quantity')->unsigned();
            $table->decimal('total_price',10, 2)->nullable();
            $table->integer('discount_percent')->unsigned()->nullable();
            $table->decimal('discount_price',10, 2)->nullable();
            $table->text('cart_enquiry_desc')->nullable();
            $table->string('order_type')->nullable();
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
        Schema::dropIfExists('carts');
    }
}
