@extends('instractor.instractor-sidebar')

@section('instructor-content')

    <div class="card">
        <div class="card-header">Create Section</div>
        @if(Session::has('Data_successfully'))
            <p class="alert {{ Session::get('alert-class', 'alert-success') }}" style="border-radius: 0 !important;">{{ Session::get('Data_successfully') }}</p>
        @endif

        <div class="card-body">
            <form method="POST" action="{{ url('instractor/create_sections_fun') }}">
                @csrf

                <input type="hidden"  name="instractorID" value="{{$instractorData->instractorID}}">


                <div class="form-group row">
                    <label for="section_name" class="col-md-4 col-form-label text-md-right">Section name</label>

                    <div class="col-md-6">
                        <input id="section_name" type="text" class="form-control{{ $errors->has('section_name') ? ' is-invalid' : '' }}" name="section_name" value="{{ old('section_name') }}" required autofocus>

                        @if ($errors->has('section_name'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('section_name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="studentIDs" class="col-md-4 col-form-label text-md-right">Students Id</label>

                    <div class="col-md-6">
                        <textarea class="form-control{{ $errors->has('studentIDs') ? ' is-invalid' : '' }}" rows="4" cols="50"  name="studentIDs" required>
                        </textarea>
                    </div>
                </div>



                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Send
                        </button>
                        <a class="btttn" href="{{ url('/instractor') }}">
                            Back
                        </a>


                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
