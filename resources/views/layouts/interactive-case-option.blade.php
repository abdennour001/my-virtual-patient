@for($option=1; $option<=$numberOfOptions; $option++)
    <div>
        <div class="row text-center">
            <div class="col-12 mb-2">
                <h4>Option {{ $option }}</h4>
            </div>
        </div>
        <div class="form-group row">
            <label for="question" class="col-sm-4 col-form-label">Question</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="question" placeholder="Enter the option..">
            </div>
        </div>
        <div class="form-group row">
            <label for="question" class="col-sm-4 col-form-label">Answer</label>
            <div class="col-sm-8">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Write the answer.."></textarea>
            </div>
        </div>
    </div>
    @if($option != $numberOfOptions)
        <hr class="my-5">
    @endif
@endfor
