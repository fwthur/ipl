<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedInteger('wisata_id');
            $table->unsignedInteger('pembeli_id');
            $table->string('jumlah_tiket');
            $table->date('tanggal');
            $table->string('jumlah_pembayaran');
            $table->string('metode_pembayaran')->nullable();
            $table->enum('status_pembayaran',['approved', 'pending'])->default('pending');
            $table->unsignedInteger('author_id')->nullable();
            $table->string('kode_unik');
            $table->char('image')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
