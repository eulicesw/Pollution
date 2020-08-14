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
            $table->timestamps();
            $table->softDeletes();
        });

        $temperature = array("name" => "Temperature", "min" => "10", "max" => "30", "neutral" => "20", "unit" => "°C");
        $humidity = array("name" => "Humidity", "min" => "20", "max" => "100", "neutral" => "40", "unit" => "RH %");
        $carbonDioxide = array("name" => "CarbonDioxide", "min" => "150", "max" => "300", "neutral" => "300", "unit" => "ppm");
        $monoxide = array("name" => "Monoxide", "min" => "0", "max" => "40", "neutral" => "9", "unit" => "ppm");

        DB::table("elements_configuration")->insert(array ($temperature, $humidity, $carbonDioxide, $monoxide));
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
