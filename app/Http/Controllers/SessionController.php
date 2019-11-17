<?php

namespace App\Http\Controllers;

use App\InteractiveCase;
use App\Section;
use App\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index() {
        return view('session/session');
    }

    public function indexLiveSessions() {
        return view('session/live-sessions');
    }

    public function indexStartSession() {
        return view('session/start-session');
    }

    public function delete($id) {
        $session = Session::findOrFail($id);
        $session->delete();
        \Illuminate\Support\Facades\Session::flash('Data_successfully', 'Session successfully deleted.');
        return back();
    }

    public function store(Request $request) {
        $name = $request['sessionName'];
        $sectionID = $request['section'];
        $interactiveCaseID = $request['interactiveCase'];
        $section = Section::findOrFail($sectionID);
        $interactiveCase = InteractiveCase::findOrFail($interactiveCaseID);

        $session = new Session();
        $session->session_name = $name;
        $session->interactiveCase()->associate($interactiveCase);
        $session->section()->associate($section);
        $session->save();
        \Illuminate\Support\Facades\Session::flash('Data_successfully', 'You successfully started a session named <'.$name.'>.');
        return back();
    }

    public function show(Request $request, $sessionID) {
        $session = Session::findOrFail($sessionID);
        $sessionName = $session->session_name;
        $interactiveCaseID = $session->interactive_case_id;

        return view('session/session', ['sessionID' => $sessionID, 'sessionName' => $sessionName, 'interactiveCaseID' => $interactiveCaseID]);
    }
}
