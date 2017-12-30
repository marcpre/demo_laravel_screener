<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $overviewArray = DB::raw('SELECT *
        FROM instruments
        LEFT join financials on instruments.id=financials.instruments_id
        WHERE financials.id IN
        ( SELECT MAX(financials.id)
        FROM financials
        GROUP BY financials.instruments_id )
        ORDER BY instruments.id ASC');
         */
        $res = DB::table('instruments')
            ->innerJoin('revisions', 'revisions.id', '=', 'instruments.id')
            ->whereIn('instruments.name', function ($query) {
                $query->select(DB::raw('MAX(financials.id)'))->
                    from('financials')->
                    groupBy('financials.instruments_id');})
            ->orderBy('instruments.id')
            ->get()
            ->toArray();
        $resArray = (array) $res;

        return view('revision.index')->with('revision', $resArray);
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
