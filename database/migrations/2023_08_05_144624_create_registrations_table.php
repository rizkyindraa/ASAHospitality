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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_registrasi');
            $table->string('no_registrasi');
            $table->boolean('status_penerimaan_membership');
            $table->date('tgl_penerimaan_membership');
            $table->string('payment');
            $table->integer('id_member');
            $table->integer('id_membership');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
