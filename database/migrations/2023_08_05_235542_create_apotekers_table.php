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
        Schema::create('apotekers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nomor_antrian');
            $table->text('resep');
            $table->enum('status', ["aktif", "done"])->default('aktif');
            $table->date('tanggal');
            $table->uuid('pasien_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apotekers');
    }
};
