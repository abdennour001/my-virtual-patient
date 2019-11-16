<?php

namespace App\Http\Controllers;

use App\Section;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
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


    public function editViewSection($id)
    {

        $Section = Section::where('sectionID',$id)->first();
        $id = Auth::guard('instractor')->user()->instractorID;
        $Sectionse = Section::where('instructor_section_id',$id)->get();
        return view('section.editViewSection',['SectionData'=>$Section,'my_section_data'=>$Sectionse]);
    }

    public function editSection(Request $request)
    {


        $rules = [
            'sectionID'=>'required',
            'section_name'=>'required|string',
            'studentIDs'=>'required|string',
        ];

        $validator = Validator::make($request->all(),$rules);


        if ($validator->fails()) {
            return back()->withErrors($validator->errors());;
        }

        $input = $request->all();



        $Section = Section::where('sectionID',$input['sectionID'])->first();
        $Section->section_name = $input['section_name'];
        $Section->studentIDs = $input['studentIDs'];
        $Section->save();

        Session::flash('Data_successfully', 'Data successfully modified');
        return redirect('/instractor');
    }

    public function deleteSection($id)
    {


        $Section = Section::where('sectionID',$id)->delete();
        Session::flash('Data_delete', 'Deleted successfully');
        return redirect('/instractor');
    }



    public function search_section(Request $request)
    {



        $rules = [
            'id'=>'required',
            'search'=>'required',
        ];

        $validator = Validator::make($request->all(),$rules);


        if ($validator->fails()) {
            return back();
        }

        $input = $request->all();

        $search = $input['search'];
        $id = $input['id'];



        $Section = Section::where('sectionID',$id)->first();
        $arr = $Section->studentIDs;

        $arrayStudents = preg_split('/\s+/', $arr);

        $items = array();
        $itemnull = array();
        foreach ($arrayStudents as $value) {
            $Student = Student::where('studentID','=',$search)->orWhere('studentName', 'LIKE', "%$search%")->first();
            if($Student){
                $items[$value] = $Student;

                return view('instractor.my_section',['SectionData'=>$Section,'arrayStudentsID'=>$arrayStudents,'arrayStudentsName'=>$items]);
            }else{

                return view('instractor.my_section',['SectionData'=>$Section,'arrayStudentsID'=>$itemnull,'arrayStudentsName'=>$itemnull]);
            }
        }

    }
}
