<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_resource', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('act_id'); //foreign key id dari act
            $table->unsignedBigInteger('resource_id'); //foreign key id dari resource
            $table->decimal('kuantitas')->default(1);
            $table->timestamps();

            $table->foreign('act_id')
                ->references('id')
                ->on('acts')
                ->onDelete('cascade'); //reff ke tabel acts untuk id

            $table->foreign('resource_id')
                ->references('id')
                ->on('resources')
                ->onDelete('cascade'); //reff ke tabel resources untuk id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('act_resource');
    }
}
