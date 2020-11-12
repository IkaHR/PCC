<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usaha_id'); //foreign key id dari usaha
            $table->foreign('usaha_id')->references('id')->on('usahas')->onDelete('cascade');; //reff ke tabel usahas untuk id
            $table->string('nama');
            $table->unsignedInteger('jenis');
            $table->decimal('umur')->default(1);
            $table->decimal('biaya', 19, 4);
            $table->decimal('perawatan', 19, 4)->default(0);
            $table->decimal('kuantitas')->default(1);
            $table->longText('deskripsi')->nullable();
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
        Schema::dropIfExists('resources');
    }
}
