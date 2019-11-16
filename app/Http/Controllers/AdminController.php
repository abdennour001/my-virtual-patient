<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Instractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function loginView()
    {
        return view('admin.loginView');
    }

    public function index()
    {
        if(!Auth::guard('admin')->user()){
            return view('admin.loginView');
// الدخول الى صفحة الدخول

        }

        $InstractorPedding = Instractor::where('instractor_status',null)->orderBy('instractorID', 'DESC')->get();
        $InstractorApproved = Instractor::where('instractor_status',1)->orderBy('instractorID', 'DESC')->get();
        return view('admin.homeAdmin',['InstractorDataPedding'=>$InstractorPedding,'InstractorDataApproved'=>$InstractorApproved]);

    }

    public function admin_login()
    {
        if(Auth::guard('admin')->attempt(['admin_email' => request('admin_email'), 'password' => request('password')])){
            return redirect('/admin');
        }
        else{
            // اذا كانت الايميل او كلمة المرور غير مطابقة

            Session::flash('messageError', 'Email or password is incorrect !');
            return back();
        }
    }
//  تحويل الى صفحة تسجيل الخروج

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/');
    }

    public function editView($id)
    {


        if(!Auth::guard('admin')->user()){


            return redirect('admin/login');
        }
        $admin = Admin::where('adminID',$id)->first();
        return view('admin.editView',['adminData'=>$admin]);
    }



    public function edit(Request $request) {

        $rules = [
            'admin_email'=>'required|email|min:3',
            'adminID'=>'required',
            'admin_mName'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'admin_fName'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'admin_lName'=>'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
        ];

        $validator = Validator::make($request->all(),$rules);


        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $input = $request->all();
        // دمج الاسماء في حقل واحد


        $full_name = $input['admin_fName'] .' '.$input['admin_mName'].' '.$input['admin_lName'];


        $Admin = Admin::where('adminID',$input['adminID'])->first();
        $Admin->admin_email = $input['admin_email'];
        $Admin->admin_mName = $input['admin_mName'];
        $Admin->admin_fName = $input['admin_fName'];
        $Admin->admin_lName = $input['admin_lName'];
        $Admin->adminName = $full_name;
        $Admin->save();


        Session::flash('Data_successfully_modified', 'Data successfully modified');
        return back();
    }

// التعديل في صفحة تغير كلمة المرور

    public function editPasswordView($id)

    {
        if(!Auth::guard('admin')->user()){
            return redirect('admin/login');
        }
        $admin = Admin::where('adminID',$id)->first();
        return view('admin.editPasswordView',['adminData'=>$admin]);
    }


    public function editPassword(Request $request) {



        $messages = [
            'password.required' => 'Field is required',
            'password.password_old' => 'Field is required',
            'password.confirmed' => 'The password confirmation does not match.',
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

        $Admin = Admin::where('adminID',$input['adminID'])->first();


        if (Hash::check($input['password_old'], $Admin->password)) {

            $input['password'] = bcrypt($input['password']);
            $input['password_old'] = bcrypt($input['password_old']);
            $input['password_confirmation'] = bcrypt($input['password_confirmation']);

            $Admin->password = $input['password'];
            $Admin->save();
            Session::flash('Data_successfully_modified_password', 'Password successfully modified');
            return back();

        }else{
            Session::flash('error_password_old', 'Please check your old password');
            return back();
        }
    }

    public function approvel($id)
        // الموافقة على طلب التسجيل في الموقع من قبل الادمن


    {
        $Instractor = Instractor::where('instractorID',$id)->first();
        $Instractor->instractor_status = 1;
        $Instractor->save();
        // return back();
        return redirect('admin');
    }

    public function disapprovel($id)
        // الرفض على عملية التسجيل من قبل الادمن


    {
        $Instractor = Instractor::where('instractorID',$id)->delete();

        return redirect('admin');

    }

    public function enable($id)

// agree

    {
        $Instractor = Instractor::where('instractorID',$id)->first();
        $Instractor->instractor_agree_disagree = 1;
        $Instractor->save();

        return redirect('admin');

    }

    public function disable($id)

// disagree

    {
        $Instractor = Instractor::where('instractorID',$id)->first();
        $Instractor->instractor_agree_disagree = 0;
        $Instractor->save();

        return redirect('admin');

    }


    public function search_pedding(Request $request)
    {

        $rules = [
            'search'=>'required',
        ];

        $validator = Validator::make($request->all(),$rules);

// Pedding Instractor


        if ($validator->fails()) {
            return back();
        }

        $input = $request->all();

        $search = $input['search'];


        $InstractorPedding = Instractor::where('instractor_status',null)->orderBy('instractorID', 'DESC')->get();
        $InstractorApproved = Instractor::where('instractor_status',1)->orderBy('instractorID', 'DESC')->get();

        $Instractor = Instractor::where('instractorName', 'LIKE', "%$search%")->where('instractor_status',null)->orderBy('instractorID', 'DESC')->get();
        return view('admin.homeAdmin',['InstractorDataPedding'=>$Instractor,'InstractorDataApproved'=>$InstractorApproved]);
    }


    public function search_approved(Request $request)

// Approved Instractor

    {

        $rules = [
            'search_approved'=>'required',
        ];

        $validator = Validator::make($request->all(),$rules);


        if ($validator->fails()) {
            return back();
        }

        $input = $request->all();

        $search = $input['search_approved'];


        $InstractorPedding = Instractor::where('instractor_status',null)->orderBy('instractorID', 'DESC')->get();


        $InstractorApproved = Instractor::where('instractor_status',1)->orderBy('instractorID', 'DESC')->get();



        if($search == 'enable' || $search == 'Enable'){
            $Instractor = Instractor::where('instractor_status',1)->where('instractor_agree_disagree',1)->orderBy('instractorID', 'DESC')->get();
            return view('admin.homeAdmin',['InstractorDataPedding'=>$InstractorPedding,'InstractorDataApproved'=>$Instractor]);


        }

        if($search == 'disable' || $search == 'Disable'){
            $Instractor = Instractor::where('instractor_status',1)->where('instractor_agree_disagree',0)->orderBy('instractorID', 'DESC')->get();
            return view('admin.homeAdmin',['InstractorDataPedding'=>$InstractorPedding,'InstractorDataApproved'=>$Instractor]);
        }



        $Instractor = Instractor::where('instractorName', 'LIKE', "%$search%")
            ->where('instractor_status',1)->orderBy('instractorID', 'DESC')->get();


        return view('admin.homeAdmin',['InstractorDataPedding'=>$InstractorPedding,'InstractorDataApproved'=>$Instractor]);
    }



}
