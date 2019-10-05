@for($question=1; $question<=$numberOfQuestions; $question++)
    <div>
        <div class="row text-center">
            <div class="col-12 mb-2">
                <h4>Question {{ $question }}</h4>
            </div>
        </div>
        <div class="form-group row">
            <label for="question" class="col-sm-4 col-form-label">Question</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="question" placeholder="Enter the question..">
            </div>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="typeQuestion" id="openEnded" value="option1" checked>
            <label class="form-check-label" for="openEnded">
                <strong>Open-Ended</strong>
            </label>
        </div>
        <div class="form-group p-5">
            <label for="exampleFormControlTextarea1">Possible keywords</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write the possible keywords of the answer.."></textarea>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="typeQuestion" id="closeEnded" value="option2">
            <label class="form-check-label" for="closeEnded">
                <strong>Close-Ended</strong>
            </label>
        </div>
        <div class="p-5">
            <div class="form-group row">
                <label for="option1" class="col-sm-4 col-form-label">Option 1</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="option1" placeholder="Enter the option 1..">
                </div>
            </div>
            <div class="form-group row">
                <label for="option2" class="col-sm-4 col-form-label">Option 2</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="option2" placeholder="Enter the option 2..">
                </div>
            </div>
            <div class="form-group row">
                <label for="option3" class="col-sm-4 col-form-label">Option 3</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="option3" placeholder="Enter the option 3..">
                </div>
            </div>
        </div>
    </div>
    @if($question != $numberOfQuestions)
        <hr>
    @endif
@endfor
