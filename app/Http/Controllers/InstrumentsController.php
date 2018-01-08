<?php

namespace App\Http\Controllers;

use App\Instruments;
use App\Revision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Log;
use Response;
use Session;
use Validator;
use Artisan;

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
                $revision->revision_status = null;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instruments  $instruments
     * @return \Illuminate\Http\Response
     */
    public function editAdmin($id)
    {
        $instruments = Instruments::find($id);

        return view('revision.edit')->with('instrumentUnderEdit', $instruments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAdmin(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'nullable|min:2|max:190',
            'sector' => 'nullable|min:3|max:190',
            'country_of_origin' => 'nullable|min:3|max:190',
        ]);
        Log::info($request->name);
        Log::info($request->sector);
        Log::info($request->country_of_origin);
        Log::info($id);

        $instrument = Instruments::find($id);

        $instrument->name = $request->name;
        $instrument->sector = $request->sector;
        $instrument->country_of_origin = $request->country_of_origin;

        $instrument->save();
        Session::flash('success', 'COIN: ' . $instrument->name . ' has been successfully updated.');
        return redirect()->route('revision.rindex');
    }

    public function updateOverview(Request $request)
    {
        try {
            Log::info('Update Overview');
            $exitCode = Artisan::call('Overview:download');
            Session::flash('success', 'Overview Updated: ' . $exitCode);
        } catch (\Exception $e) {
            Session::flash('error', 'Error: ' . $e);
        }
        return redirect()->route('revision.rindex');
    }
    
    public function details($id)
    {
        $instrument = Instruments::find($id);
        Log::info($instrument);

        return view('details')->with('instrumentUnderEdit', $instrument);
    }

    public function editDetails($id)
    {
        $instrument = Instruments::find($id);
        Log::info($instrument);

        return view('edit')->with('instrumentUnderEdit', $instrument);
    }

    public function updateDetails()
    {
        //
    }
}
