<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use DB;

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
        
        Log::info($revArray);

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
