@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login Instractor</div>
                @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}" style="border-radius: 0 !important;">{{ Session::get('message') }}</p>
                @endif
                @if(Session::has('messageError'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}" style="border-radius: 0 !important;">{{ Session::get('messageError') }}</p>
                @endif
                

                <div class="card-body">
                    <form method="POST" action="{{ url('instractor/instractor_login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="instractor_email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="instractor_email" type="email" class="form-control{{ $errors->has('instractor_email') ? ' is-invalid' : '' }}" name="instractor_email" value="{{ old('instractor_email') }}" required autofocus>

                                @if ($errors->has('instractor_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('instractor_email') }}</strong>
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
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                    <a class="btn btn-link" href="{{ url('instractor/password/reset') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
