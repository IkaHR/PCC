<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubActsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_acts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('act_id');
            $table->foreign('act_id')->references('id')->on('acts'); //reff ke tabel acts untuk id
            $table->string('nama');
            $table->longText('deskripsi')->nullable();
            $table->unsignedInteger('frekuensi')->default(1); // default pengulangan aktivitas = 1
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
        Schema::dropIfExists('sub_acts');
    }
}
