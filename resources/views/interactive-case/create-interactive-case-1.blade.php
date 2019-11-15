@extends('layouts.app')

@section('content')

<div class="container" style="overflow: hidden">
    <div class="row text-center p-5">
        <div class="col-12">
            <h2 style="color: dodgerblue">Create Interactive case 1</h2>
            <h3 style="color: dodgerblue">(Make Patient Character)</h3>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-12">
            <make-patient-character></make-patient-character>
        </div>
    </div>
    <div class="row text-right my-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-end">
                <refresh-button  class="mr-auto"></refresh-button>
                <a class="btn btn-dark" href="{{ url('/create-interactive-case-2') }}">Next<i class="fa fa-angle-right ml-2 font-weight-bolder"></i></a>
            </div>
        </div>
    </div>
</div>

@endsection
