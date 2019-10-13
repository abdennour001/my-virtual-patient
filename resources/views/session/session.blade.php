@extends('layouts.app')

@section('content')

    <div class="container w-75 p-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">Session name</h2>
            </div>
        </div>
        <div class="p-5">
            <div class="d-flex flex-row justify-content-center">
                <span class="mr-auto align-self-center" style="font-size: 1.2rem"><i class="fa fa-clock-o mr-2"></i>20:00</span>
                <a class="btn btn-danger" href="#">End</a>
            </div>
            <div class="d-flex justify-content-center my-4">
                <img src="{{ asset('assets/patient.png')  }}" alt="Patient image goes here.." class="w-25"/>
            </div>
            <div class="row text-center">
                <div class="col-12 jumbotron py-2" style="padding: 0;width: 100%">
                    <p class="m-0" style="font-size: 1rem">you can ask me a question about my condition bellow, and every thing i say will be written here...</p>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-between">
                <a style="width: 15%;" type="submit" class="btn btn-dark" href="#"><i class="fa fa-angle-left mr-2 font-weight-bolder"></i>Previous</a>
                <a style="width: 15%;" class="btn btn-dark" href="#">Next<i class="fa fa-angle-right ml-2 font-weight-bolder"></i></a>
            </div>
            <div class="d-flex flex-column justify-content-center p-5">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="typeQuestion" id="answer" value="option1" checked>
                    <label class="form-check-label" for="answer">
                        <strong>Answer</strong>
                    </label>
                </div>
                <div class="form-group px-5 pt-4">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write the answer.."></textarea>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="typeQuestion" id="askQuestion" value="option1">
                    <label class="form-check-label" for="askQuestion">
                        <strong>Ask me a question</strong>
                    </label>
                </div>
                <div class="form-group row px-5 pt-4">
                    <div class="col-sm-12">
                        <select id="nonverbalExpressions" class="form-control form-control-md custom-select">
                            <option>What is.. ?</option>
                            <option>When.. ?</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
