@extends('layouts.app')

@section('content')

    <div class="container w-75 p-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">Start Session</h2>
            </div>
        </div>
        <form class="p-5">
            <div class="form-group row">
                <label for="sessionName" class="col-sm-4 col-form-label">Session name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="sessionName" placeholder="Enter session name..">
                </div>
            </div>
            <div class="form-group row">
                <label for="section" class="col-sm-4 col-form-label">Select the Section</label>
                <div class="col-sm-8">
                    <select id="section" class="form-control form-control-md custom-select">
                        <option>Section 1</option>
                        <option>Section 2</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="interactiveCase" class="col-sm-4 col-form-label">Select the interactive case</label>
                <div class="col-sm-8">
                    <select id="interactiveCase" class="form-control form-control-md custom-select">
                        <option>interactive case 1</option>
                        <option>interactive case 2</option>
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
