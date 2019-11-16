@extends('instractor.instractor-sidebar')

@section('instructor-content')

    <div class="card">
        <div class="card-header">Instractor</div>

        <div class="card-body">
            Welcome {{ Auth::guard('instractor')->user()->instractorName }}
        </div>
    </div>

@endsection
