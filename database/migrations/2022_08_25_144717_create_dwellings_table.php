<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDwellingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dwellings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->string('name');
            $table->string('slug');
            $table->string('category');
            $table->tinyInteger('rooms')->nullable();
            $table->tinyInteger('beds')->nullable();
            $table->tinyInteger('bathrooms')->nullable();
            $table->smallInteger('dimentions')->nullable();
            $table->decimal('long',9,6);
            $table->decimal('lat',8,6);
            $table->string('address');
            $table->string('city');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('visible')->default(1);
            $table->mediumInteger('price');
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
        Schema::dropIfExists('dwellings');
    }
}
