<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InteractiveCaseController extends Controller
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
        return view('interactive-case/interactive-case');
    }

    public function indexAll() {
        return view('interactive-case/my-interactive-cases');
    }

    public function indexCreateInteractiveCase1(Request $request) {
        return view('interactive-case/create-interactive-case-1');
    }

    public function indexCreateInteractiveCase2(Request $request) {
        return view('interactive-case/create-interactive-case-2');
    }

    public function indexDeleteInteractiveCase(Request $request) {
        return view('interactive-case/delete-interactive-case');
    }

    public function indexEditInteractiveCase1(Request $request) {
        return view('interactive-case/edit-interactive-case-1');
    }
    public function indexEditInteractiveCase2(Request $request) {
        return view('interactive-case/edit-interactive-case-2');
    }

    // create a new interactive case
    public function store(Request $request) {
        print ($request['interactiveCaseName']);

        

    }
}
