@extends('instractor.instractor-sidebar')

@section('instructor-content')

<div class="card">
    <div class="card-header">Edit Password </div>
    @if(Session::has('Data_successfully_modified_password'))
        <p class="alert {{ Session::get('alert-class', 'alert-success') }}" style="border-radius: 0 !important;">{{ Session::get('Data_successfully_modified_password') }}</p>
    @endif

    @if(Session::has('error_password_old'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}" style="border-radius: 0 !important;">{{ Session::get('error_password_old') }}</p>
    @endif


    <div class="card-body">
        <form method="POST" action="{{ url('instractor/edit_password') }}">
            @csrf

            <input type="hidden"  name="instractorID" value="{{$instractorData->instractorID}}">


            <div class="form-group row">
                <label for="password_old" class="col-md-4 col-form-label text-md-right">Old Password</label>

                <div class="col-md-6">
                    <input id="password_old" type="password" class="form-control{{ $errors->has('password_old') ? ' is-invalid' : '' }}" name="password_old" required>

                    @if ($errors->has('password_old'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_old') }}</strong>
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

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Edit
                    </button>
                    <a class="btttn" href="{{ url('/instractor') }}">
                        Back
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
