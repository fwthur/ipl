<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWisatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wisatas', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedInteger('category_id')->nullable();
            $table->string('name');
            $table->longText('description');
            $table->longText('alamat');
            $table->string('no_telp')->default('-');
            $table->string('facebook')->default('-');
            $table->string('instagram')->default('-');
            $table->string('twitter')->default('-');
            $table->string('youtube')->default('-');
            $table->string('longitude')->default('-');
            $table->string('latitude')->default('-');
            $table->string('harga');
            $table->time('jam_buka');
            $table->time('jam_tutup');
            $table->string('hari');
            $table->char('image');
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
        Schema::dropIfExists('wisatas');
    }
}
