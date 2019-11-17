<?php

namespace App\Http\Controllers;

use App\Instractor;
use App\Section;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class InstractorController extends Controller
{
    public function loginView()
    {
        return view('instractor.loginView');
    }

    public function index()
    {

        if(!Auth::guard('instractor')->user()){
            return redirect('instractor/login');
        }
        $id = Auth::guard('instractor')->user()->instractorID;
        $Section = Section::where('instructor_section_id',$id)->get();
        return view('instractor.homeInstractor',['my_section_data'=>$Section]);
    }

    public function instractor_login() {
        if(Auth::guard('instractor')->attempt(['instractor_email' => request('instractor_email'), 'password' => request('password')
        ])){
            $i = Instractor::where('instractor_email' , request('instractor_email'))->first();

            //      Your order status is pending  !!

            if($i->instractor_status !== null){

//      your account is currently disabled !  !!

                if($i->instractor_status == 1){
                    if($i->instractor_agree_disagree == 1){

                        $id = $i->instractorID;
                        $Section = Section::where('instructor_section_id',$id)->get();
                        return view('instractor.homeInstractor',['my_section_data'=>$Section]);
                    }else{
                        Session::flash('message', 'Sorry you cannot log in, your account is currently disabled !');

                        Auth::guard('instractor')->logout();
                        return back();
                    }
                }else{
                    Session::flash('message', 'Sorry, you cannot sign in. Your order status is rejected !');

                    Auth::guard('instractor')->logout();
                    return back();
                }
            }else{
                Session::flash('message', 'Sorry, you cannot sign in. Your order status is pending !');

                Auth::guard('instractor')->logout();
                return back();
            }
        }
        else{
            Session::flash('messageError', 'Email or password is incorrect !');
            // ادا كانت كلمة المرور غير صحيحة


            Auth::guard('instractor')->logout();
            return back();
        }
    }
//  تسجيل الخروج

    public function logout() {
        Auth::guard('instractor')->logout();
        return redirect('/');


    }

    public function registerView() {
        return view('instractor.registerView');
    }

    public function instractor_register(Request $request) {
        {


            $messages = [
                'password.required' => 'Field is required',
                'password.min' => 'The password must be at least 8 characters',
                'password.regex' => 'The password format is invalid. inputs must be in Letters and numbers',
            ];


            $validator = Validator::make($request->all(), [
                'password'=>'required|min:8|regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
                'instractor_email'=>'required|unique:instractor',
                'instractor_mName'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
                'instractor_fName'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
                'instractor_lName'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
                'instractor_university'=>'required',
            ], $messages);


            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }



            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            // دمج الاسماء  في حقل واحد

            $full_name = $input['instractor_fName'] .' '.$input['instractor_mName'].' '.$input['instractor_lName'];


            $email = $input['instractor_email'].'@ksu.edu.sa';



// Open a new object and add data to it

            $instractor = new Instractor;
            $instractor->instractor_email = $email;
            $instractor->password = $input['password'];
            $instractor->instractor_mName = $input['instractor_mName'];
            $instractor->instractor_fName = $input['instractor_fName'];
            $instractor->instractor_lName = $input['instractor_lName'];
            $instractor->instractorName = $full_name;
            $instractor->instractor_university = $input['instractor_university'];
            $instractor->instractor_status = null;
            $instractor->instractor_agree_disagree = 0;
            $instractor->save();




            Session::flash('RegisterDoneMsg', 'Your account has been successfully registered, wait for the activation of the account by the administration');


            return redirect('/');
        }

    }

    public function editView($id)


    {
        if(!Auth::guard('instractor')->user()){
            return redirect('instractor/login');
        }

        $id = Auth::guard('instractor')->user()->instractorID;
        $Sectionse = Section::where('instructor_section_id',$id)->get();
        $instractor = Instractor::where('instractorID',$id)->first();
        return view('instractor.editView',['instractorData'=>$instractor,'my_section_data'=>$Sectionse]);
    }


    public function edit(Request $request) {



        $rules = [
            'instractor_email'=>'required|min:3',
            'instractorID'=>'required',
            'instractor_mName'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'instractor_fName'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'instractor_lName'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'instractor_university'=>'required|string',
        ];


        $validator = Validator::make($request->all(),$rules);


        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }



        $input = $request->all();


        $full_name = $input['instractor_fName'] .' '.$input['instractor_mName'].' '.$input['instractor_lName'];



        $instractor = Instractor::where('instractorID',$input['instractorID'])->first();
        $instractor->instractor_email = $input['instractor_email'];
        $instractor->instractor_mName = $input['instractor_mName'];
        $instractor->instractor_fName = $input['instractor_fName'];
        $instractor->instractor_lName = $input['instractor_lName'];
        $instractor->instractorName = $full_name;
        $instractor->instractor_university = $input['instractor_university'];
        $instractor->save();


        Session::flash('Data_successfully_modified', 'Data successfully modified');
        return back();
    }



    public function editPasswordView($id)
    {
        if(!Auth::guard('instractor')->user()){
            return redirect('instractor/login');
        }
        $id = Auth::guard('instractor')->user()->instractorID;
        $Sectionse = Section::where('instructor_section_id',$id)->get();
        $instractor = Instractor::where('instractorID',$id)->first();
        return view('instractor.editPasswordView',['instractorData'=>$instractor,'my_section_data'=>$Sectionse]);
    }

    public function editPassword(Request $request) {



        $messages = [
            'password.required' => 'Field is required',
            'password.min' => 'The password must be at least 8 characters',
            'password.regex' => 'The password format is invalid. inputs must be in Letters and numbers',
            'password.confirmed' => 'The password confirmation does not match.',
        ];

        $validator = Validator::make($request->all(), [
            'password'=>'required|confirmed|min:8|regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            'password_old'=>'required',
        ], $messages);


        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $input = $request->all();

        $instractor = Instractor::where('instractorID',$input['instractorID'])->first();
// مطابقة كلمة المرور


        if (Hash::check($input['password_old'], $instractor->password)) {

            $input['password'] = bcrypt($input['password']);
            $input['password_old'] = bcrypt($input['password_old']);
            $input['password_confirmation'] = bcrypt($input['password_confirmation']);

            $instractor->password = $input['password'];
            $instractor->save();
//اذا نجحت  كتابة كلمة المرور القديمة كتابة رسالة
            Session::flash('Data_successfully_modified_password', 'Password successfully modified');
            return back();

        }else{
//اذا فشلت كتابة كلمة المرور القديمة كتابة رسالة

            Session::flash('error_password_old', 'Please check your old password');
            return back();
        }
    }


    public function create_sections($id)
    {
        if(!Auth::guard('instractor')->user()){
            return redirect('instractor/login');
        }

        $id = Auth::guard('instractor')->user()->instractorID;
        $Sectionse = Section::where('instructor_section_id',$id)->get();
        $instractor = Instractor::where('instractorID',$id)->first();
        return view('instractor.create_sections',['instractorData'=>$instractor,'my_section_data'=>$Sectionse]);
    }


    public function create_sections_fun(Request $request)
    {


        $rules = [
            'instractorID'=>'required',
            'section_name'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'studentIDs'=>'required',
        ];

        $validator = Validator::make($request->all(),$rules);


        if ($validator->fails()) {
            return back()->withErrors($validator->errors());;
        }

        $input = $request->all();
        // Open a new object and add data to it



        $Section = new Section;
        $Section->section_name = $input['section_name'];
        $Section->studentIDs = $input['studentIDs'];
        $Section->instructor_section_id = $input['instractorID'];
        $Section->save();


        Session::flash('Data_successfully', 'Section successfully created');
        return redirect('/instractor');
    }


    public function get_my_section($id)


    {
        $Section = Section::where('sectionID',$id)->first();
        $id = Auth::guard('instractor')->user()->instractorID;
        $Sectionse = Section::where('instructor_section_id',$id)->get();
        $arr = $Section->studentIDs;


        $arrayStudents = preg_split('/\s+/', $arr);

        $items = array();
        foreach ($arrayStudents as $value) {
            $Student = Student::where('studentID','=',$value)->first();
            $items[$value] = $Student;
        }
        return view('instractor.my_section',['SectionData'=>$Section,'arrayStudentsID'=>$arrayStudents,'arrayStudentsName'=>$items,'my_section_data'=>$Sectionse]);
    }
}
