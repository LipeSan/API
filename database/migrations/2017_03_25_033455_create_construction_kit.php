<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstructionKit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('construction_kit', function (Blueprint $table) {
            $table->integer('construction_id')->unsigned();
            $table->foreign('construction_id')
                ->references('id')
                ->on('constructions');

            $table->integer('kit_id')->unsigned();
            $table->foreign('kit_id')
                ->references('id')
                ->on('kits');
            $table->integer('quantity')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('construction_kit');
    }
}
