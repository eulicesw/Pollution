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
use Exception;

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
        $carbonDioxides = CarbonDioxide::whereBetween('hour', [$from, $to])->orderBy('hour', 'ASC')->get();
        $temperatures = Temperature::whereBetween('hour', [$from, $to])->orderBy('hour', 'ASC')->get();
        $humidities = Humidity::whereBetween('hour', [$from, $to])->orderBy('hour', 'ASC')->get();
        $monoxides = Monoxide::whereBetween('hour', [$from, $to])->orderBy('hour', 'ASC')->get();
        $nitrogens = Nitrogens::whereBetween('hour', [$from, $to])->orderBy('hour', 'ASC')->get();
        $ozones = Ozones::whereBetween('hour', [$from, $to])->orderBy('hour', 'ASC')->get();
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

    public function getDataChart(Request $request) {
        $toDate = $request->toDate;
        $request->toDate = date_create($request->toDate);
        date_time_set($request->toDate, 23, 59, 59);
        // Log::info($request->id);
        // Log::info($request->fromDate);
        // Log::info(date_format($request->toDate, 'Y-m-d H:i:s'));
        switch ($request->id) {
            case 1: $data = Temperature::whereBetween('hour', [$request->fromDate, $request->toDate])->orderBy('hour', 'DESC')->get();
                break;
            case 2: $data = Humidity::whereBetween('hour', [$request->fromDate, $request->toDate])->orderBy('hour', 'DESC')->get();
                break;
            case 3: $data = CarbonDioxide::whereBetween('hour', [$request->fromDate, $request->toDate])->orderBy('hour', 'DESC')->get();
                break;
            case 4: $data = Monoxide::whereBetween('hour', [$request->fromDate, $request->toDate])->orderBy('hour', 'DESC')->get();
                break;
            case 5: $data = Nitrogens::whereBetween('hour', [$request->fromDate, $request->toDate])->orderBy('hour', 'DESC')->get();
                break;
            case 6: $data = Ozones::whereBetween('hour', [$request->fromDate, $request->toDate])->orderBy('hour', 'DESC')->get();
                break;
            default: $data = null;
                break;
        }
        if ($data !== null) {
            return response()->json([
                'state' => 'Success',
                'data' => $data,
                'fromDate' => $request->fromDate,
                'toDate' => $toDate
            ], 200);
        } else {
            return response()->json([
                'state' => 'Server error'
            ], 500);
        }
    }
}
