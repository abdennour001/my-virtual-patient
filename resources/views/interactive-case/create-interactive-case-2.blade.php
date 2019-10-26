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
                <h2 style="color: dodgerblue">Create Interactive case 2</h2>
                <h3 style="color: dodgerblue">(Make Patient Replies)</h3>
            </div>
        </div>
        <interactive-case-form></interactive-case-form>
        <div class="row text-right">
            <div class="col-12">
                <a class="btn btn-dark" href="#">Next<i class="fa fa-angle-right ml-2 font-weight-bolder"></i></a>
            </div>
        </div>
    </div>

@endsection
