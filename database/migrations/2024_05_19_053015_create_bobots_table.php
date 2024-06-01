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
        Schema::create('bobots', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kriteria');
            $table->string('nama_sub_kriteria');
            $table->string('bobot');
            $table->timestamps();

            $table
                ->foreign('kode_kriteria')
                ->references('kode_kriteria')
                ->on('kriterias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bobots');
    }
};
