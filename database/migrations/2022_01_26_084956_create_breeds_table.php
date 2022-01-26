<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breeds', function (Blueprint $table) {
            $table->id();
            $table->text('name'); // trzeba pamiętać o walidowaniu przy tworzeniu
            $table->float('phMin', 4, 2, true);
            $table->float('phMax', 4, 2, true);

            // licencja obrazka https://www.freepikcompany.com/legal#nav-freepik-agreement
            $table->text('image_link')->default('https://image.flaticon.com/icons/png/512/628/628283.png');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('breeds');
    }
}
