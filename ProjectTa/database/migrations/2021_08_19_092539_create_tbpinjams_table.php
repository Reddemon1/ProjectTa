<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbpinjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbpinjams', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nama',100);
            $table->string('kelas',100);
            $table->string('kelompok',20);
            $table->string('kodebarang',20);
            $table->string('lokasi',20);
            $table->string('jumlah',20);
            $table->string('nis_id',20);
            $table->dateTime('tgl_pinjam');
            $table->dateTime('tgl_kembali');
            $table->enum('status',['Sudah','Belum']);
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
        Schema::dropIfExists('tbpinjams');
    }
}
