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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('foto');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('mulai_kontrak');
            $table->date('selesai_kontrak');
            $table->string('unit_bisnis');
            $table->string('jabatan');
            $table->string('nik');
            $table->string('no_telp');
            $table->string('gender');
            $table->string('status');
            $table->string('alamat');
            $table->string('nama_emergency');
            $table->string('hubungan');
            $table->string('no_telp_emergency');
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
        Schema::dropIfExists('users');
    }
};
