<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActCostrateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_costrate', function (Blueprint $table) {
            $table->unsignedBigInteger('act_id'); //foreign key id dari act
            $table->decimal('biaya', 19, 4);

            $table->foreign('act_id')
                ->references('id')
                ->on('acts')
                ->onDelete('cascade'); //reff ke tabel acts untuk id

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
        Schema::dropIfExists('act_costrate');
    }
}
