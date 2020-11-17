<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_produk', function (Blueprint $table) {
            $table->unsignedBigInteger('direct_id'); //foreign key id dari direct_exp
            $table->unsignedBigInteger('produk_id'); //foreign key id dari produk
            $table->decimal('kuantitas')->default(1);
            $table->timestamps();

            $table->foreign('direct_id')
                ->references('id')
                ->on('direct_exps')
                ->onDelete('cascade'); //reff ke tabel direct_exps untuk id

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
        Schema::dropIfExists('direct_produk');
    }
}
