@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }} Student</div>
                @if(Session::has('messageErrorRegister'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}" style="border-radius: 0 !important;">{{ Session::get('messageErrorRegister') }}</p>
                @endif
                

                <div class="card-body">
                    <form method="POST" action="{{ url('student/student_register') }}">
                        @csrf


                        <div class="form-group row">
                            <label for="student_fName" class="col-md-4 col-form-label text-md-right">First Name</label>

                            <div class="col-md-6">
                                <input id="student_fName" type="text" class="form-control{{ $errors->has('student_fName') ? ' is-invalid' : '' }}" name="student_fName" value="{{ old('student_fName') }}" required>

                                @if ($errors->has('student_fName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('student_fName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="student_mName" class="col-md-4 col-form-label text-md-right">Middle Name</label>

                            <div class="col-md-6">
                                <input id="student_mName" type="text" class="form-control{{ $errors->has('student_mName') ? ' is-invalid' : '' }}" name="student_mName" value="{{ old('student_mName') }}" required>

                                @if ($errors->has('student_mName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('student_mName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="student_lName" class="col-md-4 col-form-label text-md-right">Last Name</label>

                            <div class="col-md-6">
                                <input id="student_lName" type="text" class="form-control{{ $errors->has('student_lName') ? ' is-invalid' : '' }}" name="student_lName" value="{{ old('student_lName') }}" required>

                                @if ($errors->has('student_lName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('student_lName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="student_email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-3">
                                <input id="student_email" type="text" class="form-control{{ $errors->has('student_email') ? ' is-invalid' : '' }}" name="student_email" value="{{ old('student_email') }}" required>
                                @if ($errors->has('student_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('student_email') }}</strong>
                                    </span>
                                @endif
                                @if(Session::has('uniqueEmail'))
                                    <p style="color: red;font-size: 11px;margin-top: 5px;">{{Session::get('uniqueEmail')}}</p>
                                @endif
                            </div>
                            <div class="col-md-3" style="margin-top: 5px;margin-left: -20px;">
                                <p>@student.ksu.edu.sa</p>
                            </div>
                        </div>


                        <div class="form-group row">
                        <label for="student_university" class="col-md-4 col-form-label text-md-right">University</label>
                        <div class="col-md-6">
                            <select class="form-control" id="sel1" name="student_university" value="{{ old('student_university') }}" required>
                                <option>king saud university</option>
                            </select>
                            @if ($errors->has('student_university'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('student_university') }}</strong>
                                </span>
                            @endif
                        </div> 
                        </div> 

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
