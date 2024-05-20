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
        Schema::create('orang_tuas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->date('tanggal_lahir_ayah');
            $table->date('tanggal_lahir_ibu');
            $table->string('nik_ayah');
            $table->string('nik_ibu');
            $table->string('phone');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orang_tuas');
    }
};
