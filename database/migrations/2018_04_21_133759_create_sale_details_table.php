<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleDetailsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sale_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status_id')->unsigned();
            $table->integer('sale_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->decimal('quantity');
            $table->decimal('discount')->nullable();
            $table->decimal('product_price');
            $table->boolean('apply_wholesale');

            $table->foreign('status_id')->references('id')->on('status')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('sale_id')->references('id')->on('sale')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('product_id')->references('id')->on('product')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sale_detail');
    }
}
