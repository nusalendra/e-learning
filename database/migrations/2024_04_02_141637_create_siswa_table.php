<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_semester_id')->constrained('kelas_semester')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('ekstrakulikuler_id')->constrained('ekstrakulikuler')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nama');
            $table->string('status_raport')->nullable();
            $table->integer('nilai_akhir')->nullable();
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
        Schema::dropIfExists('siswa');
    }
};
