<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_produk', function (Blueprint $table) {
            $table->unsignedBigInteger('act_id'); //foreign key id dari act
            $table->unsignedBigInteger('produk_id'); //foreign key id dari produk
            $table->unsignedInteger('frekuensi')->default(1);
            $table->timestamps();

            $table->foreign('act_id')
                ->references('id')
                ->on('acts')
                ->onDelete('cascade'); //reff ke tabel acts untuk id

            $table->foreign('produk_id')
                ->references('id')
                ->on('produks')
                ->onDelete('cascade'); //reff ke tabel produks untuk id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('act_produk');
    }
}
