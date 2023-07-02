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
        Schema::create('akademiks', function (Blueprint $table) {
            $table->id();
            $table->integer('id_mhs');
            $table->integer('angkatan');
            $table->integer('id_prodi');
            $table->integer('kabupaten');
            $table->integer('jk');
            $table->integer('sma');
            $table->integer('q_kab');
            $table->integer('q_jk');
            $table->integer('q_sma');
            $table->float('semester_1');
            $table->float('semester_2');
            $table->float('semester_3');
            $table->float('semester_4');
            $table->float('semester_5');
            $table->float('semester_6');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akademiks');
    }
};
