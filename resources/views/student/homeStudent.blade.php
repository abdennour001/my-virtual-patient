@extends('student.student-sidebar')

@section('student-content')
    <div class="card">
        <div class="card-header">Student</div>
        <div class="card-body">
            Welcome {{ Auth::guard('student')->user()->studentName }}
        </div>
    </div>
@endsection
