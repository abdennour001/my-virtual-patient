@extends('layouts.app')

@section('content')

    @include('layouts.my-content')

    <div class="container w-75 p-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">My Interactive Cases</h2>
            </div>
        </div>
        <div class="row text-center p-5">
            @foreach($cases = \App\InteractiveCase::all() as $case)
                <div class="col-12 my-2">
                    <a class="btn btn-primary" href="{{ url('/interactive-case/'.$case->id) }}">{{ $case->interactive_case_name }}</a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
