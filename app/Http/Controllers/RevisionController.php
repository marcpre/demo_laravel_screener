<?php

namespace App\Http\Controllers;

use App\Instruments;
use App\Revision;
use DB;
use Illuminate\Http\Request;
use Log;

class RevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /* SQL Query:
        SELECT *
        FROM instruments AS p
        INNER JOIN revisions AS r ON p.revisions_id = r.id
        WHERE p.name IN (
        SELECT p.name FROM instruments AS p
        INNER JOIN revisions AS r ON p.revisions_id = r.id
        GROUP BY p.name
        HAVING COUNT(IFNULL(r.revision_status, 0)) > 1)
        ORDER BY p.name
         */
        $revArray = DB::table('instruments')
            ->join('revisions', 'revisions.id', '=', 'instruments.revisions_id')
            ->whereIn('instruments.name', function ($query) {
                $query->select('instruments.name')
                    ->from('instruments')
                    ->join('revisions', 'revisions.id', '=', 'instruments.revisions_id')
                    ->groupBy('instruments.name')
                    ->havingRaw('COUNT(IFNULL(revisions.revision_status, 0)) > 1');
            })
            ->orderBy('instruments.name')
            ->get();
//            ->toArray();
        //        $revArray = (array) $res;
        //        Log::info($revArray);

        return view('revision.rindex')->with('revArray', $revArray);
    }

    public function approve($revisionId)
    {
        // Get revision and master
        $revisionSlave = Revision::where('id', $revisionId)->get()->first();
        $slave = Instruments::where('instruments.revisions_id', $revisionSlave->id)->get()->first();
        $master = Instruments::join('revisions', 'revisions.id', '=', 'instruments.revisions_id')
            ->where([
                ['instruments.name', '=', $slave->name],
                ['revisions.revision_status', '=', 1],
            ])->get()->first();

        // Compare slave and master
        if (!($master->country_of_origin === $slave->country_of_origin)) {
            $master->country_of_origin = $slave->country_of_origin;
            $revisionSlave->revision_status = false;
        }

        if (!($master->sector === $slave->sector)) {
            $master->sector = $slave->sector;
            $revisionSlave->revision_status = false;
        }

        //save to db
        $master->save();
        $slave->save();
        $revisionSlave->save();

        return redirect()->route('revision.rindex');
    }

    public function disapprove($revisionId)
    {
        $revisionSlave = Revision::where('id', $revisionId)->get()->first();
        $revisionSlave->revision_status = false;
        $revisionSlave->save();
        return redirect()->route('revision.rindex');
    }

    public function filter(Request $request)
    {
        /* SQL Query:
        SELECT *
        FROM instruments AS p
        INNER JOIN revisions AS r ON p.revisions_id = r.id
        WHERE p.name IN (
        SELECT p.name FROM instruments AS p
        INNER JOIN revisions AS r ON p.revisions_id = r.id
        GROUP BY p.name
        HAVING COUNT(IFNULL(r.revision_status, 0)) > 1)
        AND r.revision_status = 1 OR r.revision_status = 0 OR r.revision_status IS NULL
        ORDER BY p.name
         */
        Log::info("Request: ");
        Log::info($request);
        Log::info($request->checkbox1);
        Log::info($request->checkbox0);
        Log::info($request->checkboxNull);

        $checkbox1 = $request->checkbox1;
        $checkbox0 = $request->checkbox0;
        $checkboxNull = $request->checkboxNull;

        $data = DB::table('instruments')
            ->join('revisions', 'revisions.id', '=', 'instruments.revisions_id')
            ->whereIn('instruments.name', function ($query) {
                $query->select('instruments.name')
                    ->from('instruments')
                    ->join('revisions', 'revisions.id', '=', 'instruments.revisions_id')
                    ->groupBy('instruments.name')
                    ->havingRaw('COUNT(IFNULL(revisions.revision_status, 0)) > 1');
            })
            ->where("revisions.revision_status", "=", $checkbox1);
        //->orWhere("revisions.revision_status", "=", $checkbox0);

        if ($checkbox0 === "0") {
            $data->orWhere("revisions.revision_status", "=", $checkbox0);
        }

        if ($checkboxNull === "NULL-VALUE") {
            $data->orWhereNull("revisions.revision_status");
        }

        $revArray = $data->orderBy('instruments.name')->get();

        return view('revision.rindex')->with('revArray', $revArray);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
