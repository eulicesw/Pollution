<?php

namespace ACA\Http\Controllers;

use Illuminate\Http\Request;
use ACA\Models\Temperature;
use ACA\Models\Humidity;
use ACA\Models\CarbonDioxide;
use ACA\Models\ElementConfiguration;

class DataSensorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // ocupamos guest para que no pida login
       $this->middleware('guest');
    }

    //
    public function insert(Request $request)
    {
        $newTemp = new Temperature();
        $newCO2 = new CarbonDioxide();
        $newhum = new Humidity();

        $hora = date("H:i:s");

        $newTemp->grade = $request->temp;
        $newCO2->grade = $request->co;
        $newhum->grade = $request->hum;

        $newTemp->hour = $hora;
        $newCO2->hour = $hora;
        $newhum->hour = $hora;

        $newTemp->save();
        $newCO2->save();
        $newhum->save();
    }
}
