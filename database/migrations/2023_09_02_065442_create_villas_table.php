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
        Schema::create('villas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_villa');
            $table->string('subtitle');
            $table->string('size');
            $table->string('occupancy');
            $table->string('bed_type');
            $table->text('deskripsi');
            $table->string('yt_link')->nullable();
            $table->string('floor_plan')->nullable();
            $table->string('ubication')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villas');
    }
};
