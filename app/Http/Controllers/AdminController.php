<?php

namespace ACA\Http\Controllers;

use Illuminate\Http\Request;
use ACA\Models\ElementConfiguration;
use Auth;
use Log;
// use Mqtt;
use Salman\Mqtt\MqttClass\Mqtt;
use Lzq\Mqtt\SamMessage;
use Lzq\Mqtt\SamConnection;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(['auth', 'admin']); 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Send data to page.
        $elements = ElementConfiguration::all();
        $user = Auth::user();
        $title = "ACA | Settings";
        return view('page.admin.admin', compact('title', 'elements', 'user'));
    }

    public function update(Request $request) {
        $element = ElementConfiguration::find($request->id);
        $element->name = $request->name;
        $element->unit = $request->unit;
        $enable = $request->switched_on;
        Log::info($request->switched_on);
        Log::info($enable);
        Log::info($request->reason);
        if ($enable) {
            $enable = 1;
        } else {
            $enable = 0;
        }
        // $element->switched_on = $enable;
        $element->reason_disabled = $request->reason;
        if ($element->save()) {
            return response()->json([
                'state' => 'updated',
            ], 200);
        } 
        return response()->json([
            'state' => 'error',
        ], 500);
    }

}
