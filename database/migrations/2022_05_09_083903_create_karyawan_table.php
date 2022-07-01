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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 25);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('tempat_lahir');
            $table->string('tanggal_lahir', 50);
            $table->string('agama', 25);
            $table->string('pendidikan_terakhir', 50);
            $table->string('status_perkawinan', 25);
            // $table->integer('tanggungan');
            // $table->text('alamat');
            // $table->string('mulai_bekerja', 50);
            // $table->integer('nomor');
            // $table->string('divisi', 25);
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
        Schema::dropIfExists('karyawan');
    }
};
