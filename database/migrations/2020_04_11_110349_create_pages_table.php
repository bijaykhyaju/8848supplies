<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('alias');
            $table->text('description')->nullable();
            $table->string('desc1')->nullable();
            $table->string('desc2')->nullable();
            $table->string('desc3')->nullable();
            $table->string('desc4')->nullable();
            $table->string('desc5')->nullable();
            $table->string('desc6')->nullable();
            $table->integer('order')->unsigned()->default(1);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('pages');
    }
}
