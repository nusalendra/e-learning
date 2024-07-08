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
        Schema::create('ekstrakulikuler_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ekstrakulikuler_id')->nullable()->constrained('ekstrakulikuler')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('siswa_id')->nullable()->constrained('siswa')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('predikat')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('ekstrakulikuler_siswa');
    }
};
