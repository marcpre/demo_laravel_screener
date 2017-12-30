<?php

namespace App\Http\Controllers;

use App\Instruments;
use App\Revision;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Log;

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
        $rules = [
            'name' => 'min:3|max:30',
        ];
        $validator = Validator::make(Input::all(), $rules);

        Log::info($validator->getMessageBag()->toArray());
        
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            try {
                $revision = new Revision();
                $revision->revision_status = false;
                $revision->save();

                $i = Instruments::find($instruments_id);

                $instru = new Instruments();
                $instru->name = $i->name;
                $instru->symbol = $i->symbol;
                $instru->image = $i->image;
                $instru->revisions_id = $revision->id;

                // comes from ajax form which field to put into the db
                if ($request->secOrcoo == "country_of_origin") {
                    $instru->country_of_origin = $request->name;
                }

                if ($request->secOrcoo == "sector") {
                    $instru->sector = $request->name;
                }

                $instru->save();

                // Session::flash('success', 'Thank you for your contribution!');
                return response()->json($instru);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
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
