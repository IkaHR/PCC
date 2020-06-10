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
            $table->unsignedBigInteger('act_id'); //foreign key id dari usaha
            $table->foreign('act_id')->references('id')->on('acts')->onDelete('cascade');; //reff ke tabel acts untuk id
            $table->longText('detail');
            $table->unsignedInteger('frekuensi')->default(1);
            $table->unsignedInteger('idx')->default(1);
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
