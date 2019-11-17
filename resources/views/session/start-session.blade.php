@extends('layouts.app')

@section('content')

    @include('layouts.my-content')


    @if(Session::has('Data_successfully'))
        <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}" style="border-radius: 0 !important;">{{ Session::get('Data_successfully') }}</p>
    @endif

    <div class="container w-75 p-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">Start Session</h2>
            </div>
        </div>
        <form class="p-5" method="post" action="{{ url('/start-session/add') }}">
            @csrf
            <div class="form-group row">
                <label for="sessionName" class="col-sm-4 col-form-label">Session name</label>
                <div class="col-sm-8">
                    <input type="text" name="sessionName" class="form-control" id="sessionName" placeholder="Enter session name.." required>
                </div>
            </div>
            <div class="form-group row">
                <label for="section" class="col-sm-4 col-form-label">Select the Section</label>
                <div class="col-sm-8">
                    <select id="section" name="section" class="form-control form-control-md custom-select" required>
                        @foreach(\App\Section::all() as $section)
                            <option value="{{ $section->sectionID }}">{{ $section->section_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="interactiveCase" class="col-sm-4 col-form-label">Select the interactive case</label>
                <div class="col-sm-8">
                    <select id="interactiveCase" name="interactiveCase" class="form-control form-control-md custom-select" required>
                        @foreach(\App\InteractiveCase::all() as $interactiveCase)
                            <option value="{{ $interactiveCase->id }}">{{ $interactiveCase->interactive_case_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-12">
                    <button type="submit" class="btn btn-dark">Start</button>
                </div>
            </div>
        </form>
    </div>

@endsection
