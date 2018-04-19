<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('location_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address', 255);
            $table->string('postal_code', 10);
            $table->string('city', 150);
            $table->string('phone', 25);
            $table->string('cell_phone', 25);
            $table->string('email', 50)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('location_data');
    }
}