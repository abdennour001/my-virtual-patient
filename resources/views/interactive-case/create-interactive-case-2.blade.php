@extends('layouts.app')

@section('content')

    <div class="container w-75 p-5">
        <div class="row text-left">
            <div class="col-12">
                <a type="submit" class="btn btn-dark" href="{{ url('/create-interactive-case-1') }}"><i class="fa fa-angle-left mr-2 font-weight-bolder"></i>Back</a>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">Create Interactive case 2</h2>
                <h3 style="color: dodgerblue">(Make Patient Replies)</h3>
            </div>
        </div>
        <interactive-case-form></interactive-case-form>
        <div class="d-flex align-items-center justify-content-end">
            <refresh-button  class="mr-auto"></refresh-button>
            <finish-button></finish-button>
        </div>
    </div>

@endsection
