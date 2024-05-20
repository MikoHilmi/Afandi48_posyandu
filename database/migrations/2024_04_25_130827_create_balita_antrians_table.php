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
        Schema::create('balita_antrians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('antrian_id');
            $table->string('nama_balita');
            $table->timestamps();

            $table->foreign('antrian_id')->references('id')->on('antrians')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balita_antrians');
    }
};
