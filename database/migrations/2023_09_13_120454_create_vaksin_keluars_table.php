<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vaksin_keluars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_vaksin');
            $table->foreign('id_vaksin')->references('id')->on('vaksins')->onDelete('cascade');
            $table->integer('jumlah_keluar');
            $table->date('tanggal_keluar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaksin_keluars');
    }
};
