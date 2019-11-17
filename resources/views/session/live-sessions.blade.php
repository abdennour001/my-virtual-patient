@extends('layouts.app')

@section('content')

    @include('layouts.my-content')

    @if(Session::has('Data_successfully'))
        <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}" style="border-radius: 0 !important;">{{ Session::get('Data_successfully') }}</p>
    @endif


    <div class="container w-75 p-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">Live Sessions</h2>
            </div>
        </div>
        <div class="row text-center p-5">
            @foreach($sessions = \App\Session::all() as $session)
                <div class="col-4 my-4">
                    <span class="lead p-0 m-0">{{ $session->session_name }}</span>
                    <a class="btn align-baseline" style="color: red;" href="{{ url('/delete-session/'.$session->id) }}"><i class="fas fa-times"></i></a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
