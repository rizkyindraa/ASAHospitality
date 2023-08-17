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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 40)->unique();
            $table->string('nama_membership');
            $table->integer('harga_membership');
            $table->integer('jumlah_voucher');
            $table->boolean('sharing_profit');
            $table->integer('discount_product');
            $table->integer('periode');
            $table->string('satuan_periode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
