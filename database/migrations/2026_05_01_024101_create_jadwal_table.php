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
    Schema::create('jadwal', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('kelas_id');
        $table->unsignedBigInteger('mata_pelajaran_id');
        $table->unsignedBigInteger('guru_id');
        $table->unsignedBigInteger('jam_pelajaran_id');
        $table->timestamps();
        $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        $table->foreign('mata_pelajaran_id')->references('id')->on('mata_pelajaran')->onDelete('cascade');
        $table->foreign('guru_id')->references('id')->on('guru')->onDelete('cascade');
        $table->foreign('jam_pelajaran_id')->references('id')->on('jam_pelajaran')->onDelete('cascade');
        $table->unique(['kelas_id', 'jam_pelajaran_id']);
        $table->unique(['guru_id', 'jam_pelajaran_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
