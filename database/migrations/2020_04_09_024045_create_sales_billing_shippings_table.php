<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesBillingShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_billing_shippings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('sales_id')->unsigned();
            $table->string('billing_first_name')->nullable();
            $table->string('billing_last_name')->nullable();
            $table->string('billing_address_1')->nullable();
            $table->string('billing_address_2')->nullable();
            $table->string('billing_town')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_postcode')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('billing_phone')->nullable();
            $table->boolean('same_as_billing')->default(false);
            $table->string('shipping_first_name')->nullable();
            $table->string('shipping_last_name')->nullable();
            $table->string('shipping_address_1')->nullable();
            $table->string('shipping_address_2')->nullable();
            $table->string('shipping_town')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_postcode')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->text('description')->nullable();


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
        Schema::dropIfExists('sales_billing_shippings');
    }
}
