<?php

namespace App\Http\Controllers;

use App\Models\Markers;
use Illuminate\Http\Request;
use App\Events\AddMarker;
use Carbon\Carbon;

class MarkersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nowData = Carbon::now();
        $markers = Markers::select('lat', 'lng', 'created_at as alive')
            ->whereBetween('created_at', [Carbon::now()->add(-1,'minute'), $nowData])
            ->get();

        foreach($markers as $key=>$value){
            $markers[$key]['alive'] = 60 - $nowData->diffInSeconds(Carbon::parse($markers[$key]['alive']));
        }

        return view('testwork', compact('markers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lat' => ['required','numeric', 'min:-90','max:90'],
            'lng' => ['required','numeric', 'min:-180','max:180'],
        ]);

        $markers = Markers::create([
            'lat' => $request->post('lat'),
            'lng' => $request->post('lng'),
        ]);

        if ( $markers ) {
            event( new AddMarker( $request->post('lat'), $request->post('lng'), 60 ));
        }

        return null;
    }
}
