<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbbarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbbarangs', function (Blueprint $table) {
            $table->id();
            $table->string('namabarang');
            $table->string('jenis',100);
            $table->string('kategori',100);
            $table->string('stock',100);
            $table->string('lokasi',100);
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
        Schema::dropIfExists('tbbarangs');
    }
}
