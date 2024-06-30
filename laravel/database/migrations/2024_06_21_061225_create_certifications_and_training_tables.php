<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{

    Schema::create('certifications', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('manpower_id');
        $table->string('title');
        $table->string('description')->nullable();
        $table->string('certificate')->nullable();
        $table->timestamps();

        $table->foreign('manpower_id')->references('id')->on('_manpower')->onDelete('cascade');
    });

    Schema::create('training', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('manpower_id');
        $table->string('title');
        $table->date('tanggal_training')->nullable();
        $table->string('description')->nullable();
        $table->timestamps();

        $table->foreign('manpower_id')->references('id')->on('_manpower')->onDelete('cascade');
    });

    Schema::table('_manpower', function (Blueprint $table) {
        $table->string('barcode')->nullable();
    });
}

public function down()
{
    Schema::dropIfExists('certifications');
    Schema::dropIfExists('training');
    Schema::table('_manpower', function (Blueprint $table) {
        $table->dropColumn('barcode');
    });
}

};
