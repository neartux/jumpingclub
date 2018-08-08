<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sale', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('personal_data_id')->unsigned();
            $table->integer('location_data_id')->unsigned();
            $table->integer('payment_type_id')->unsigned();
            $table->dateTime('created_at');
            $table->dateTime('event_date');
            $table->string('event_time', 50);
            $table->decimal('subtotal', 8, 2);
            $table->decimal('taxes', 8, 2)->nullable();
            $table->decimal('total_discount', 8, 2)->nullable();
            $table->decimal('total', 8, 2);
            $table->decimal('balance', 8, 2);
            $table->decimal('advance_payment', 8, 2);
            $table->decimal('amount_pay', 8, 2)->nullable();
            $table->text('comments')->nullable();

            $table->foreign('status_id')->references('id')->on('status')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('client_id')->references('id')->on('client')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('personal_data_id')->references('id')->on('personal_data')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('location_data_id')->references('id')->on('location_data')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('payment_type_id')->references('id')->on('payment_type')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sale');
    }
}
