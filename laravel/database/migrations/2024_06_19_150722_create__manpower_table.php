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
        Schema::create('_manpower', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('badge_number');
            $table->string('no_register');
            $table->string('area_kerja');
            $table->string('customer');
            $table->string('departemen');
            $table->string('jabatan');
            $table->string('tipe_permit');
            $table->string('gender');
            $table->date('masa_berlaku_permit');
            $table->string('permit_status');
             $table->string('image');     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_manpower');
    }
};
