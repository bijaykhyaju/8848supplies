<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('session_id');
            $table->boolean('sale_status')->default(0);
            $table->dateTime('payment_date', 0)->nullable()->default(null);
            $table->boolean('payment_status')->default(0);
            $table->dateTime('dispatch_date', 0)->nullable()->default(null);
            $table->boolean('dispatch_status')->default(0);
            $table->decimal('delivery_amount',10, 2)->nullable();
            $table->decimal('payment_charge',10, 2)->nullable();
            $table->decimal('dispatch_charge',10, 2)->nullable();
            $table->text('dispatch_note')->nullable();
            $table->boolean('cancel_status')->default(0);
            $table->dateTime('cancel_date', 0)->nullable()->default(null);
            $table->text('cancel_note')->nullable();
            $table->decimal('tax_amount',10, 2)->nullable();
            $table->string('invoice_number')->nullable(); //formate INVW-000030
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
        Schema::dropIfExists('sales');
    }
}
