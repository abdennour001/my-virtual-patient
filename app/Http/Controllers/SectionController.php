<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;
use Illuminate\View\View;
use mysql_xdevapi\Schema;

class SectionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function create(Request $request) {
        return View('section/create-section');
    }

    public function store(Request $request) {
        $number = $request['number'];
        $file = $request['file'];

        $section = new Section();
        $section->section_number = $number;
        $section->path_excel_sheet = $file;
        $section->save();

        return back();
    }
}
