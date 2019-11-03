@extends('layouts.app')

@section('content')

    <div>
        <session session-id="{{ $sessionID }}" session-name="{{ $sessionName }}" interactive-case-id="{{ $interactiveCaseID }}"></session>
    </div>

@endsection
