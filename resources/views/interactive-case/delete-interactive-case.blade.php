@extends('layouts.app')

@section('content')

    <div class="container w-75 p-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">Delete Interactive case</h2>
            </div>
        </div>
        <form class="p-5">
            <div class="form-group row">
                <label for="gender" class="col-sm-4 col-form-label">Select the interactive case</label>
                <div class="col-sm-8">
                    <select id="gender" class="form-control form-control-md custom-select">
                        <option>1</option>
                        <option>2</option>
                    </select>
                </div>
            </div>
            <div class="row text-center my-4">
                <div class="col-12">
                    <button type="submit" class="btn btn-dark">Delete</button>
                </div>
            </div>
        </form>
    </div>

@endsection
