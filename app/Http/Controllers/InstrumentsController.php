<?php

namespace App\Http\Controllers;

use App\Contributor;
use App\Event;
use App\Instruments;
use App\Revision;
use App\Team;
use App\Social;
use Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Log;
use Response;
use Session;
use Validator;

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

    /**
     * Return the details from the db
     */
    public function getDetails($id)
    {

        $instruments = Instruments::join('revisions', 'revisions.id', '=', 'instruments.revisions_id')
            ->where([
                ['revisions.revision_status', '=', '1'],
                ['instruments.id', '=', $id],
            ])
            ->orderBy('instruments.name')
            ->first();

        $team = Team::join('instruments', 'teams.instruments_id', '=', 'instruments.id')
            ->join('revisions', 'revisions.id', '=', 'teams.revisions_id')
            ->where([
                ['revisions.revision_status', '=', '1'],
                ['instruments.id', '=', $id],
            ])
            ->orderBy('instruments.name')
            ->get();

        $event = Event::join('instruments', 'events.instruments_id', '=', 'instruments.id')
            ->join('revisions', 'revisions.id', '=', 'events.revisions_id')
            ->where([
                ['revisions.revision_status', '=', '1'],
                ['instruments.id', '=', $id],
            ])
            ->orderBy('instruments.name')
            ->get();

        $codeRepo = Social::join('instruments', 'socials.instruments_id', '=', 'instruments.id')
            ->join('revisions', 'revisions.id', '=', 'socials.revisions_id')
            ->where([
                ['revisions.revision_status', '=', '1'],
                ['instruments.id', '=', $id],
                ['socials.type', '=', 'github'],
            ])
            ->orderBy('instruments.name')
            ->get();

        $result = array($instruments, $team, $event, $codeRepo);
        return $result;
    }

    public function details($id)
    {
        Log::info("res");

/*        list($instrument, $team, $event) = $this->getDetails($id);

return view('details')->with('instrumentUnderEdit', $instrument)->with('teamUnderEdit', $team);
 */
        list($instrument, $team, $event, $codeRepo) = $this->getDetails($id);

        return view('details')->with('instrumentUnderEdit', $instrument)
            ->with('teamUnderEdit', $team)
            ->with('eventUnderEdit', $event)
            ->with('codeRepoUnderEdit', $codeRepo);
    }

    /**
     * Team
     **/
    public function editTeamDetails($id)
    {
        $instrument = Instruments::find($id);

        return view('detailsTeamEdit')->with('instrumentUnderEdit', $instrument);
    }

    public function updateTeamDetails(Request $request, $id)
    {
        $this->validate($request, [
            'firstName' => 'nullable|min:3|max:190',
            'lastName' => 'nullable|min:3|max:190',
            'twitter' => 'nullable|min:3|max:190',
            'team.*.firstName' => 'nullable|min:3|max:190',
            'team.*.lastName' => 'nullable|min:3|max:190',
            'team.*.twitter' => 'nullable|min:3|max:190',
            'userName' => 'required|min:1|max:190',
            'email' => 'required|email',
        ], [
            'team.*.firstName.min' => 'The firstname must be at least :min.',
            'team.*.firstName.max' => 'The firstname should maximal be :max.',
            'team.*.lastName.min' => 'The lastname must be at least :min.',
            'team.*.lastName.max' => 'The lastname should maximal be :max.',
            'team.*.twitter.min' => 'The Twitter Link must be at least :min.',
            'team.*.twitter.max' => 'The Twitter Link should maximal be :max.',
        ]);

        try {
            $revision = new Revision();
            $revision->revision_status = null;
            $revision->save();

            $i = Instruments::find($id);

            Log::info("res");
            Log::info($request);

            //save user
            $contributor = new Contributor();
            $contributor->name = $request['userName'];
            $contributor->email = $request['email'];
            $contributor->save();

            foreach ($request['team'] as $key => $value) {

                $team = new Team();
                $team->firstname = $value['firstName'];
                $team->lastname = $value['lastName'];
                $team->twitterAccount = $value['twitter'];
                $team->instruments_id = $i->id;
                $team->revisions_id = $revision->id;
                $team->contributors_id = $contributor->id;
                $team->save();
            }

            list($instrument, $team, $event) = $this->getDetails($id);

            Session::flash('success', 'Thank you for your contribution!');
            return view('details')
                ->with('instrumentUnderEdit', $instrument)
                ->with('teamUnderEdit', $team)
                ->with('eventUnderEdit', $event)
                ->with('codeRepoUnderEdit', $codeRepo);        
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Event
     **/
    public function editEventDetails($id)
    {
/*        $instrument = Instruments::find($id);

return view('detailsEventEdit')->with('instrumentUnderEdit', $instrument);
 */
        list($instrument, $team, $event, $codeRepo) = $this->getDetails($id);

        return view('detailsEventEdit')->with('instrumentUnderEdit', $instrument)
            ->with('teamUnderEdit', $team)
            ->with('eventUnderEdit', $event)
            ->with('codeRepoUnderEdit', $codeRepo);
    }

    public function updateEventDetails(Request $request, $id)
    {
        $this->validate($request, [
            'eventName' => 'nullable|min:3|max:190',
            'eventLink' => 'nullable|min:3|max:190',
            'eventDate' => 'nullable|min:3|max:190',
            'event.*.eventName' => 'nullable|min:3|max:190',
            'event.*.eventLink' => 'nullable|min:3|max:190',
            'event.*.eventDate' => 'nullable|min:3|max:190',
            'userName' => 'required|min:1|max:190',
            'email' => 'required|email',
        ], [
            'event.*.eventName.min' => 'The Event Name must be at least :min.',
            'event.*.eventName.max' => 'The Event Name should maximal be :max.',
            'event.*.eventLink.min' => 'The Event Link must be at least :min.',
            'event.*.eventLink.max' => 'The Event Link should maximal be :max.',
            'event.*.eventDate.min' => 'The Twitter Link must be at least :min.',
            'event.*.eventDate.max' => 'The Twitter Link should maximal be :max.',
        ]);

        try {
            $revision = new Revision();
            $revision->revision_status = null;
            $revision->save();

            $i = Instruments::find($id);

            Log::info("res");
            Log::info($request);

            //save user
            $contributor = new Contributor();
            $contributor->name = $request['userName'];
            $contributor->email = $request['email'];
            $contributor->save();

            foreach ($request['event'] as $key => $value) {

                $event = new Event();
                $event->name = $value['eventName'];
                $event->link = $value['eventLink'];
                $event->date = $value['eventDate'];
                $event->instruments_id = $i->id;
                $event->revisions_id = $revision->id;
                $event->contributors_id = $contributor->id;
                $event->save();
            }

            list($instrument, $team, $event) = $this->getDetails($id);

            Session::flash('success', 'Thank you for your contribution!');
            return view('details')
                ->with('instrumentUnderEdit', $instrument)
                ->with('teamUnderEdit', $team)
                ->with('eventUnderEdit', $event)
                ->with('codeRepoUnderEdit', $codeRepo);      
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Code Repo
     **/
    public function editCodeRepoDetails($id)
    {

        list($instrument, $team, $event, $codeRepo) = $this->getDetails($id);

        return view('detailsCodeRepoEdit')->with('instrumentUnderEdit', $instrument)
            ->with('teamUnderEdit', $team)
            ->with('eventUnderEdit', $event)
            ->with('codeRepoUnderEdit', $codeRepo);
    }

    public function updateCodeRepoDetails(Request $request, $id)
    {
        $this->validate($request, [
            'codeRepoLink' => 'url|min:3|max:190',
            'codeRepo.*.codeRepoLink' => 'nullable|min:3|max:190',
            'userName' => 'required|min:1|max:190',
            'email' => 'required|email',
        ], [
            'codeRepo.*.codeRepoLink' => 'The link to the code repo must be at least :min.',
        ]);

        try {
            $revision = new Revision();
            $revision->revision_status = null;
            $revision->save();

            $i = Instruments::find($id);

            Log::info("res");
            Log::info($request);

            //save user
            $contributor = new Contributor();
            $contributor->name = $request['userName'];
            $contributor->email = $request['email'];
            $contributor->save();

            foreach ($request['codeRepo'] as $key => $value) {

                $codeRepo = new Social();
                $codeRepo->link = $value['codeRepoLink'];
                $codeRepo->type = 'github';
                $codeRepo->instruments_id = $i->id;
                $codeRepo->revisions_id = $revision->id;
                $codeRepo->contributors_id = $contributor->id;
                $codeRepo->save();
            }

            list($instrument, $team, $event, $codeRepo) = $this->getDetails($id);

            Session::flash('success', 'Thank you for your contribution!');
            return view('details')
                ->with('instrumentUnderEdit', $instrument)
                ->with('teamUnderEdit', $team)
                ->with('eventUnderEdit', $event)
                ->with('codeRepoUnderEdit', $codeRepo);      
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
