<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('balitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ortu');
            $table->string('nama_balita');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir_balita');
            $table->enum('jenis_kelamin_balita', ['laki-laki', 'perempuan']);
            $table->timestamps();

            $table->foreign('id_ortu')->references('id')->on('orang_tuas')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balitas');
    }
};
