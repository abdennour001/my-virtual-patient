@extends('student.student-sidebar')

@section('student-content')

    <div class="card">
        <div class="card-header">Live sessions </div>

        <div class="card-body">
            @foreach(\App\Session::all() as $session)
                @foreach($data as $d)
                    @foreach($d as $s)
                        @if($s->sectionID == $session->section_id)
                            <a class="btn" style="color: dodgerblue;" href="{{ url('session/'.$session->id) }}">{{ $session->session_name }}</a>
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
