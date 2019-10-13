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
                <h2 style="color: dodgerblue">Create Interactive case 3</h2>
                <h3 style="color: dodgerblue">(Ask Patient)</h3>
            </div>
        </div>
        <form class="p-5">
            <div class="form-group row">
                <label for="numberOfOptions" class="col-sm-4 col-form-label">Number of options</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="numberOfOptions" placeholder="Enter number of options..">
                </div>
            </div>

            <div class="p-5">
                @include('layouts/interactive-case-option', ['numberOfOptions' => 2])
            </div>

        </form>

        <div class="row text-right">
            <div class="col-12">
                <a class="btn btn-dark" href="#">Next<i class="fa fa-angle-right ml-2 font-weight-bold"></i></a>
            </div>
        </div>
    </div>

@endsection
