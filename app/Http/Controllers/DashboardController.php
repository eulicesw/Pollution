<?php

namespace ACA\Http\Controllers;

use Log;
use Auth;
use Illuminate\Http\Request;
use ACA\Models\Temperature;
use ACA\Models\Humidity;
use ACA\Models\CarbonDioxide;
use ACA\Models\Monoxide;
use ACA\Models\Nitrogens;
use ACA\Models\Ozones;
use ACA\Models\ElementConfiguration;


class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get data from today.
        $from = date("Y-m-d");
        $to = date("Y-m-d H:i:s");
        // Send data to page.
        $carbonDioxides = CarbonDioxide::whereBetween('hour', [$from, $to])->get();
        $temperatures = Temperature::whereBetween('hour', [$from, $to])->get();
        // $temperatures = Temperature::all();
        $humidities = Humidity::whereBetween('hour', [$from, $to])->get();
        $monoxides = Monoxide::whereBetween('hour', [$from, $to])->get();
        $nitrogens = Nitrogens::whereBetween('hour', [$from, $to])->get();
        $ozones = Ozones::whereBetween('hour', [$from, $to])->get();
        $elements_configuration = ElementConfiguration::all();
        $user = Auth::user();
        $title = "ACA | Dashboard";
        // Log::info($from);
        // Log::info($to);
        Log::info($temperatures);
        return view('page.dashboard._dashboard', compact('title', 'temperatures', 'humidities', 'carbonDioxides', 'monoxides', 'nitrogens', 'ozones', 'elements_configuration', 'user'));
    }

    public function update() 
    {
        $carbonDioxides = CarbonDioxide::latest()->first();
        $temperatures = Temperature::latest()->first();
        $humidities = Humidity::latest()->first();
        $monoxides = Monoxide::latest()->first();
        $nitrogens = Nitrogens::latest()->first();
        $ozones = Ozones::latest()->first();
        return response()->json([
            'state' => 'updated',
            'temperatures' => $temperatures,
            'humidities' => $humidities,
            'carbondioxides' => $carbonDioxides,
            'monoxides' => $monoxides,
            'nitrogens' => $nitrogens,
            'ozones' => $ozones,
        ], 200);
    }
}
