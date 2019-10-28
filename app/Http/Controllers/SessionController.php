<?php

namespace App\Http\Controllers;

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
}
