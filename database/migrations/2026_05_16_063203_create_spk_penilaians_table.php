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
        Schema::create('spk_penilaians', function (Blueprint $table) {
            $table->id();
            $table->string('nama_responden');
            $table->integer('c1'); // Harga
            $table->integer('c2'); // Keindahan
            $table->integer('c3'); // Perawatan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spk_penilaians');
    }
};
