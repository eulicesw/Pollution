<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementsConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements_configuration', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('min', 10);
            $table->string('max', 10);
            $table->string('neutral', 10);
            $table->string('unit', 10);
            $table->boolean('switched_on')->default(true);
            $table->string('colour', 50);
            $table->string('reason_disabled', 250)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        $temperature = array("name" => "Temperature", "min" => "15", "max" => "50", "neutral" => "35", "unit" => "°C", "switched_on" => true, "colour" => "rgb(255, 159, 64)");
        $humidity = array("name" => "Humidity", "min" => "20", "max" => "100", "neutral" => "40", "unit" => "RH %", "switched_on" => true, "colour" => "rgb(54, 162, 235)");
        $carbonDioxide = array("name" => "CarbonDioxide", "min" => "400", "max" => "1000", "neutral" => "600", "unit" => "ppm", "switched_on" => true, "colour" => "rgb(75, 192, 192)");
        $monoxide = array("name" => "Monoxide", "min" => "15", "max" => "100", "neutral" => "70", "unit" => "ppm", "switched_on" => true, "colour" => "rgb(255, 99, 132)");
        $nitrogen = array("name" => "Nitrogen", "min" => "40", "max" => "100", "neutral" => "70", "unit" => "ppb", "switched_on" => true, "colour" => "rgb(153, 102, 255)");
        $ozone = array("name" => "Ozone", "min" => "50", "max" => "500", "neutral" => "110", "unit" => "ppb", "switched_on" => true, "colour" => "rgb(255, 205, 86)");

        DB::table("elements_configuration")->insert(array ($temperature, $humidity, $carbonDioxide, $monoxide, $nitrogen, $ozone));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elements_configuration');
    }
}
