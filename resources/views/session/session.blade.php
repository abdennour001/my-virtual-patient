@extends('layouts.app')

@section('content')

    @include('layouts.my-content-student')

    <div>
        <session session-id="{{ $sessionID }}" session-name="{{ $sessionName }}" interactive-case-id="{{ $interactiveCaseID }}"></session>
    </div>

@endsection
