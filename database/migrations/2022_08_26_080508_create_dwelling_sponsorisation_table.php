<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDwellingSponsorisationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dwelling_sponsorisation', function (Blueprint $table) {

            $table->unsignedBigInteger('dwelling_id');

            $table->foreign('dwelling_id')
                  ->references('id')
                  ->on('dwellings')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('sponsorisation_id');

            $table->foreign('sponsorisation_id')
                  ->references('id')
                  ->on('sponsorisations')
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
        Schema::dropIfExists('dwelling_sponsorisation');
    }
}
