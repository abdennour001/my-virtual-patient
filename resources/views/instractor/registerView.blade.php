@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }} Instractor</div>
                @if(Session::has('messageErrorRegister'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}" style="border-radius: 0 !important;">{{ Session::get('messageErrorRegister') }}</p>
                @endif
                

                <div class="card-body">
                    <form method="POST" action="{{ url('instractor/instractor_register') }}">
                        @csrf


                        <div class="form-group row">
                            <label for="instractor_fName" class="col-md-4 col-form-label text-md-right">First Name</label>

                            <div class="col-md-6">
                                <input id="instractor_fName" type="text" class="form-control{{ $errors->has('instractor_fName') ? ' is-invalid' : '' }}" name="instractor_fName" value="{{ old('instractor_fName') }}" required>

                                @if ($errors->has('instractor_fName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('instractor_fName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="instractor_mName" class="col-md-4 col-form-label text-md-right">Middle Name</label>

                            <div class="col-md-6">
                                <input id="instractor_mName" type="text" class="form-control{{ $errors->has('instractor_mName') ? ' is-invalid' : '' }}" name="instractor_mName" value="{{ old('instractor_mName') }}" required>

                                @if ($errors->has('instractor_mName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('instractor_mName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="instractor_lName" class="col-md-4 col-form-label text-md-right">Last Name</label>

                            <div class="col-md-6">
                                <input id="instractor_lName" type="text" class="form-control{{ $errors->has('instractor_lName') ? ' is-invalid' : '' }}" name="instractor_lName" value="{{ old('instractor_lName') }}" required>

                                @if ($errors->has('instractor_lName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('instractor_lName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="instractor_email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-3">
                                <input id="instractor_email" type="text" class="form-control{{ $errors->has('instractor_email') ? ' is-invalid' : '' }}" name="instractor_email" value="{{ old('instractor_email') }}" required>

                                @if ($errors->has('instractor_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('instractor_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3" style="margin-top: 5px;margin-left: -20px;">
                                <p>@ksu.edu.sa</p>
                            </div>
                        </div>


                        <div class="form-group row">
                        <label for="instractor_university" class="col-md-4 col-form-label text-md-right">University</label>
                        <div class="col-md-6">
                            <select class="form-control" id="sel1" name="instractor_university" value="{{ old('instractor_university') }}" required>
                                <option>king saud university</option>
                            </select>
                            @if ($errors->has('instractor_university'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('instractor_university') }}</strong>
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
