@extends('layouts.app')

@section('content')

    <div class="container w-75 p-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">Create a section</h2>
            </div>
        </div>
        <form class="p-5" method="post" action="{{ url('/create-section/add') }}">
            @csrf
            <div class="form-group row">
                <label for="sectionNumber" class="col-sm-4 col-form-label">Section number</label>
                <div class="col-sm-8">
                    <input required type="number" name="number" class="form-control" id="sectionNumber" placeholder="Enter section number..">
                </div>
            </div>
            <div class="form-group row">
                <label for="file" class="col-sm-4 col-form-label">Section Excel file</label>
                <div class="col-sm-8">
                    <input type="file" name="file" class="form-control" id="file" placeholder="Please enter path to excel file..">
                </div>
            </div>
            <div class="form-check text-center">
                <button type="submit" class="btn btn-primary">Add section</button>
            </div>
        </form>
    </div>

@endsection
