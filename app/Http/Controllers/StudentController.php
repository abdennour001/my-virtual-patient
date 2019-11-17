<?php

namespace App\Http\Controllers;

use App\Section;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function loginView()
    {
        return view('student.loginView');
    }

    public function index()
    {

        if(!Auth::guard('student')->user()){
            return redirect('student/login');
        }


        $Section = Section::get();

        $itemsSection = array();
        foreach ($Section as $valueSection) {

            $itemsSection[$valueSection->sectionID] = [$valueSection->studentIDs];
        }

        $itemsss = array();
        foreach ($Section as $valueSection) {
            $arrayStudents = preg_split('/\s+/', $valueSection->studentIDs);
            $itemsss[$valueSection->sectionID] = $arrayStudents;
        }


        $std_id = Auth::guard('student')->user()->studentID;
        $std_id_str = (string)$std_id;

        $items = array();
        foreach ($itemsss as $key => $value) {


            foreach ($value as $c) {
                if($c == $std_id_str){
                    $items[$key] = $std_id_str;
                }
            }
        }


        $arrfinal = array();
        foreach ($items as $key => $value) {
            $Student = Section::where('sectionID','=',$key)->get();

            $arrfinal[] = $Student;
        }


        return view('student.homeStudent',['data'=>$arrfinal]);
    }

    public function student_login()


    {


        if(Auth::guard('student')->attempt(['student_email' => request('student_email'), 'password' => request('password')])){
            return redirect('student');
        }
        else{
// اذا كانت الايميل او كلمة المرور غير مطابقة

            Session::flash('messageError', 'Email or password is incorrect !');
            return back();
        }
    }
//   الى صفحة تسجيل الخروج

    public function logout() {
        Auth::guard('student')->logout();


        return redirect('/');
    }

    public function registerView() {
        return view('student.registerView');
    }


    public function student_register(Request $request) {
        {


            $messages = [
                'password.required' => 'Field is required',
                'password.min' => 'The password must be at least 8 characters',
                'password.regex' => 'The password format is invalid. inputs must be in Letters and numbers',
            ];

            $validator = Validator::make($request->all(), [
                'password'=>'required|min:8|regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
                'student_email'=>'required|unique:student|digits:9',
                'student_mName'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
                'student_fName'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
                'student_lName'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
                'student_university'=>'required',
            ], $messages);


            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }


            $input = $request->all();


            $std = Student::get();
            foreach ($std as $value) {
                if($value->studentID == $input['student_email']){
                    Session::flash('uniqueEmail', 'The email you entered already exists');
                    return redirect()->back()->withInput();

                }
            }


            $input['password'] = bcrypt($input['password']);
            // دمج الاسماء في حقل واحد

            $full_name = $input['student_fName'] .' '.$input['student_mName'].' '.$input['student_lName'];


            $email = $input['student_email'].'@student.ksu.edu.sa';
// Open a new object and add data to it

            $Student = new Student;
            $Student->studentID = $input['student_email'];
            $Student->student_email = $email;
            $Student->password = $input['password'];
            $Student->student_mName = $input['student_mName'];
            $Student->student_fName = $input['student_fName'];
            $Student->student_lName = $input['student_lName'];
            $Student->studentName = $full_name;
            $Student->student_university = $input['student_university'];
            $Student->save();

            Session::flash('RegisterDoneMsgStudents', 'Your account has been successfully registered');

            return redirect('/');
        }

    }

    public function editView($id)


    {
        if(!Auth::guard('student')->user()){

            return redirect('student/login');
        }


        $student = student::where('studentID',$id)->first();
        return view('student.editView',['studentData'=>$student]);
    }



    public function edit(Request $request) {

        $rules = [
            'student_email'=>'required',
            'studentID'=>'required',
            'student_mName'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'student_fName'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'student_lName'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'student_university'=>'required|string',
        ];

        $validator = Validator::make($request->all(),$rules);


        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $input = $request->all();
// دمج الاسماء  في حقل واحد

        $full_name = $input['student_fName'] .' '.$input['student_mName'].' '.$input['student_lName'];


        $student = student::where('studentID',$input['studentID'])->first();
        $student->student_email = $input['student_email'];
        $student->student_mName = $input['student_mName'];
        $student->student_fName = $input['student_fName'];
        $student->student_lName = $input['student_lName'];
        $student->studentName = $full_name;
        $student->student_university = $input['student_university'];
        $student->save();

        Session::flash('Data_successfully_modified', 'Data successfully modified');
        return back();
    }



    public function editPasswordView($id) {
        if(!Auth::guard('student')->user()){
            return redirect('student/login');
        }
        $student = student::where('studentID',$id)->first();


        return view('student.editPasswordView',['studentData'=>$student]);
    }


    public function editPassword(Request $request) {

// مطابقة كلمة المرور

        $messages = [
            'password.required' => 'Field is required',
            'password.min' => 'The password must be at least 8 characters',
            'password.regex' => 'The password format is invalid. inputs must be in Letters and numbers',
        ];

        $validator = Validator::make($request->all(), [
            'password'=>'required|confirmed|min:8|regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            'password_old'=>'required',
        ], $messages);


        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $input = $request->all();

        $student = student::where('studentID',$input['studentID'])->first();


        if (Hash::check($input['password_old'], $student->password)) {

            $input['password'] = bcrypt($input['password']);
            $input['password_old'] = bcrypt($input['password_old']);
            $input['password_confirmation'] = bcrypt($input['password_confirmation']);

            $student->password = $input['password'];
            $student->save();

            Session::flash('Data_successfully_modified_password', 'Password successfully modified');
            return back();

        }else{


            Session::flash('error_password_old', 'Please check your old password');
            return back();
        }
    }

    public function showLiveSessions() {
        if(!Auth::guard('student')->user()){
            return redirect('student/login');
        }

        $Section = Section::get();

        $itemsSection = array();
        foreach ($Section as $valueSection) {

            $itemsSection[$valueSection->sectionID] = [$valueSection->studentIDs];
        }

        $itemsss = array();
        foreach ($Section as $valueSection) {
            $arrayStudents = preg_split('/\s+/', $valueSection->studentIDs);
            $itemsss[$valueSection->sectionID] = $arrayStudents;
        }


        $std_id = Auth::guard('student')->user()->studentID;
        $std_id_str = (string)$std_id;

        $items = array();
        foreach ($itemsss as $key => $value) {


            foreach ($value as $c) {
                if($c == $std_id_str){
                    $items[$key] = $std_id_str;
                }
            }
        }


        $arrfinal = array();
        foreach ($items as $key => $value) {
            $Student = Section::where('sectionID','=',$key)->get();

            $arrfinal[] = $Student;
        }

        return view('student.live-sessions', ['data'=>$arrfinal]);
    }

}
