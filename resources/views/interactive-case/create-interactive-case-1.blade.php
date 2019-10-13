@extends('layouts.app')

@section('content')

<div class="container w-75 p-5">
    <div class="row text-center">
        <div class="col-12">
            <h2 style="color: dodgerblue">Create Interactive case 1</h2>
            <h3 style="color: dodgerblue">(Make Patient Character)</h3>
        </div>
    </div>
    <form class="p-5">
        <div class="form-group row">
            <label for="name" class="col-sm-4 col-form-label">Interactive case name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="name" placeholder="Enter the name..">
            </div>
        </div>
        <div class="form-group row">
            <label for="gender" class="col-sm-4 col-form-label">Gender of the patient</label>
            <div class="col-sm-8">
                <select id="gender" class="form-control form-control-md custom-select">
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="age" class="col-sm-4 col-form-label">Age of the patient</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" id="age" placeholder="Enter age..">
            </div>
        </div>
        <div class="form-group row">
            <label for="condition" class="col-sm-4 col-form-label">Patient condition</label>
            <div class="col-sm-8">
                <select id="condition" class="form-control form-control-md custom-select">
                    <option>Injured</option>
                    <option>Healthy</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="type" class="col-sm-4 col-form-label">Injury type</label>
            <div class="col-sm-8">
                <select id="type" class="form-control form-control-md custom-select">
                    <option>Critical</option>
                    <option>Smooth</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="facialExpression" class="col-sm-4 col-form-label">Facial expression</label>
            <div class="col-sm-8">
                <select id="facialExpression" class="form-control form-control-md custom-select">
                    <option>Critical</option>
                    <option>Smooth</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="nonverbalExpressions" class="col-sm-4 col-form-label">Nonverbal expressions</label>
            <div class="col-sm-8">
                <select id="nonverbalExpressions" class="form-control form-control-md custom-select">
                    <option>Critical</option>
                    <option>Smooth</option>
                </select>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <button type="submit" class="btn btn-dark">Apply</button>
            </div>
        </div>
    </form>
    <div class="row text-center my-2">
        <div class="col-12">
            <img src="{{ asset('assets/patient.png')  }}" alt="Patient image goes here.." class="w-25"/>
        </div>
    </div>
    <div class="row text-right">
        <div class="col-12">
            <a class="btn btn-dark" href="#">Next<i class="fa fa-angle-right ml-2 font-weight-bolder"></i></a>
        </div>
    </div>
</div>

@endsection
