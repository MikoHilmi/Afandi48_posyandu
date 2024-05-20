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
        Schema::create('vitamin_keluars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_vitamin');
            $table->foreign('id_vitamin')->references('id')->on('vitamins')->onDelete('cascade');
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
        Schema::dropIfExists('vitamin_keluars');
    }
};
