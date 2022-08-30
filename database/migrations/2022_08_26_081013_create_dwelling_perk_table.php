<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDwellingPerkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dwelling_perk', function (Blueprint $table) {

            $table->unsignedBigInteger('dwelling_id');

            $table->foreign('dwelling_id')
                  ->references('id')
                  ->on('dwellings')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('perk_id');

            $table->foreign('perk_id')
                  ->references('id')
                  ->on('perks')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dwelling_perk');
    }
}
