<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable('false');
            $table->bigInteger('breed_id')->unsigned()->nullable('false');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('breed_id')->references('id')->on('breeds')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->timestamp('last_watering')->useCurrent();
            $table->enum('visibility', ['private', 'public'])->default('private')->nullable('false');
            $table->text('image_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plants');
    }
}
