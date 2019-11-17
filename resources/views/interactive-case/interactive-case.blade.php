@extends('layouts.app')

@section('content')

    @include('layouts.my-content')

    <div class="container w-75 p-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">{{ $interactive_case->interactive_case_name }}</h2>
            </div>
        </div>
        <div class="row text-center my-5">
            <div class="col-12">
                <img src="{{ asset($virtual_character)  }}" alt="Patient image goes here.." class="w-25"/>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12 jumbotron py-2" style="padding: 0;width: 100%">
                <p class="m-0" style="font-size: 1rem">Hello! i am the virtual patient of this interactive case...</p>
            </div>
        </div>

        @for($i=0; $i<$count; $i++)
            <div class="card my-2">
                    <div class="card-header">
                        <div class="col-12">
                            <h4>Question {{ $i+1 }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12 text-left">
                            <h5 style="color: dodgerblue;">Answer of the patient:</h5>
                            <p class="lead">{{ $questions[$i]['patientAnswer'] }}</p>
                        </div>
                        <div class="col-12 text-left">
                            <h5 style="color: dodgerblue;">Standard and related questions:</h5>
                            @foreach($questions[$i]['questions'] as $question)
                                <p class="lead">{{ $question->question_body }}</p>
                            @endforeach
                        </div>
                    </div>
            </div>
        @endfor
{{--        <div class="p-5">--}}
{{--            @include('layouts/interactive-case-question', ['numberOfQuestions' => 2])--}}
{{--        </div>--}}
    </div>

@endsection
