@extends('layouts.app')

@section('content')

    <div class="container w-75 p-5">
        <div class="row text-left">
            <div class="col-12">
                <a type="submit" class="btn btn-dark" href="#"><i class="fa fa-angle-left mr-2 font-weight-bolder"></i>Back</a>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">Edit Interactive case 2</h2>
                <h3 style="color: dodgerblue">(Make Patient Replies)</h3>
            </div>
        </div>
        <form class="p-5">
            <div class="form-group row">
                <label for="numberOfQuestions" class="col-sm-4 col-form-label">Number of questions</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="numberOfQuestions" placeholder="Enter number of questions..">
                </div>
            </div>
            <div class="form-group row">
                <label for="time" class="col-sm-4 col-form-label">Time</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="time" placeholder="Enter time in minutes..">
                </div>
            </div>

            <div class="p-5">
                @include('layouts/interactive-case-question', ['numberOfQuestions' => 2])
            </div>

        </form>
        <div class="row text-right">
            <div class="col-12">
                <a class="btn btn-dark" href="#">Next<i class="fa fa-angle-right ml-2 font-weight-bolder"></i></a>
            </div>
        </div>
    </div>

@endsection
