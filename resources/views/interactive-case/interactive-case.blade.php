@extends('layouts.app')

@section('content')

    <div class="container w-75 p-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">Interactive case</h2>
            </div>
        </div>
        <div class="row text-center my-5">
            <div class="col-12">
                <img src="{{ asset('assets/patient.png')  }}" alt="Patient image goes here.." class="w-25"/>
            </div>
        </div>
        <div class="p-5">
            @include('layouts/interactive-case-question', ['numberOfQuestions' => 2])
        </div>
    </div>

@endsection
