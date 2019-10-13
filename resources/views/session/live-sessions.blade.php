@extends('layouts.app')

@section('content')

    <div class="container w-75 p-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">Live Sessions</h2>
            </div>
        </div>
        <div class="row text-center p-5">
            @for($session=1;$session<=3;$session++)
                <div class="col-12 my-4">
                    <a class="btn btn-primary" href="#">Start Session {{ $session }}</a>
                </div>
            @endfor
        </div>
    </div>

@endsection
