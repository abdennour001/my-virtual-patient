@extends('layouts.app')

@section('content')

    @include('layouts.my-content')

    @if(Session::has('Data_successfully'))
        <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}" style="border-radius: 0 !important;">{{ Session::get('Data_successfully') }}</p>
    @endif

    <div class="container w-75 p-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">My Interactive Cases</h2>
            </div>
        </div>
        <div class="row text-center p-5">
            @foreach($cases = \App\InteractiveCase::all() as $case)
                <div class="col-4 my-2">
                    <a class="btn align-baseline" style="color: dodgerblue;" href="{{ url('instractor/interactive-case/'.$case->id) }}">{{ $case->interactive_case_name }}</a>
                    <a href="{{ url('/delete-interactive-case/'.$case->id) }}" style="color: red;"><i class="fas fa-times"></i></a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
