<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbusers', function (Blueprint $table) {
            $table->string('id',10)->primary();
            $table->string('email',100);
            $table->string('password',100);
            $table->string('nama',100);
            $table->string('status',100);
            $table->string('kelas',10);
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
        Schema::dropIfExists('tbusers');
    }
}
