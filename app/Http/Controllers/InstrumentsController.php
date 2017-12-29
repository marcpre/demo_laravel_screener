<?php

namespace App\Http\Controllers;

use App\Instruments;
use App\Revision;
use Debugbar;
use Illuminate\Http\Request;
use Log;
use Session;

class InstrumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Update the specified resource in storage. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Instruments  $instruments
     * @return \Illuminate\Http\Response
     */
    public function show($instrumentsId)
    {        
        Log::info("instru: " . $instrumentsId);
        
        $instru = Instruments::find($instrumentsId);
        return response()->json($instru);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instruments  $instruments
     * @return \Illuminate\Http\Response
     */
    public function edit(Instruments $instruments)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instruments  $Instruments
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $instruments_id)
    {
        $this->validate($request, [
            'name' => 'min:3|max:30',
        ]);
        
        try {
            $revision = new Revision();
            $revision->revision_status = false;
            $revision->save();
            
            Log::info("request: " . $request);

            $i = Instruments::find($instruments_id);
            
            $instru = new Instruments();
            $instru->name = $i->name;
            $instru->symbol  = $i->symbol;
            $instru->image = $i->image;            
            $instru->country_of_origin = $request->name;
            $instru->revisions_id = $revision->id;
            
            Log::info("instru: " . $instru);
            Log::info("type: " . $request->type);
            Log::info("data: " . $request->data);
            Log::info("name: " . $request->name);
            
            $instru->save();

            Session::flash('success', 'Thank you for your contribution!');
            return redirect()->route('index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instruments  $Instruments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instruments $Instruments)
    {
        //
    }
}
