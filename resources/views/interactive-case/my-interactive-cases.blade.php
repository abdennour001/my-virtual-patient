@extends('layouts.app')

@section('content')

    <div class="container w-75 p-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">My Interactive Cases</h2>
            </div>
        </div>
        <div class="row text-center p-5">
            @for($case=1;$case<=3;$case++)
                <div class="col-12 my-4">
                    <a class="btn btn-primary" href="#">Interactive Case {{ $case }}</a>
                </div>
            @endfor
        </div>
    </div>

@endsection
