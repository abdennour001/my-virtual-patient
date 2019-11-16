<?php

namespace App\Http\Controllers;

use App\AnswerOfPatient;
use App\InteractiveCase;
use App\Keyword;
use App\OpenEnded;
use App\Patient;
use App\QuestionForPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InteractiveCaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index($id) {
        if(!Auth::guard('instractor')->user()){
            return redirect('instractor/login');
        }

        $interactiveCase = InteractiveCase::find($id);
        $patient = $interactiveCase->patient();
        $answers = $interactiveCase->answersOfPatient();
        
        return view('interactive-case/interactive-case', ['interactive-case'=>$interactiveCase, 'virtual_character' => $patient->virtual_character]);
    }

    public function indexAll() {
        return view('interactive-case/my-interactive-cases');
    }

    public function indexCreateInteractiveCase1(Request $request) {
        return view('interactive-case/create-interactive-case-1');
    }

    public function indexCreateInteractiveCase2(Request $request) {
        return view('interactive-case/create-interactive-case-2');
    }

    public function indexDeleteInteractiveCase(Request $request) {
        return view('interactive-case/delete-interactive-case');
    }

    public function indexEditInteractiveCase1(Request $request) {
        return view('interactive-case/edit-interactive-case-1');
    }
    public function indexEditInteractiveCase2(Request $request) {
        return view('interactive-case/edit-interactive-case-2');
    }

    // create a new interactive case
    public function store(Request $request) {
        try {
            $interactiveCaseName = $request['interactiveCaseName'];
            $patientGender = $request['patientGender'];
            $patientAge = $request['patientAge'];
            $virtualPatientPath = $request['patientCharacterPath'];
            $numberOfQuestions = $request['numberOfQuestions'];
            $time = $request['time'];

            // Structure of questions
            /**
             * $questions = [
             *
             *          every question will contain:
             *          'patientAnswer' + #numberOfQuestion => ''
             *          'primaryQuestion' + #numberOfQuestion => ''
             *          'primaryKeywords' + #numberOfQuestion => [
             *                                            'id' => Integer
             *                                            'text' => ''
             *                                      ]
             *          'primaryKeywords' + #numberOfQuestion => [
             *                                  'id' =>
             *                                  'question' => ''
             *                                  'keywords' => [
             *                                        'id' =>
             *                                        'text' => ''
             *                                  ]
             *                          ]
             * ]
             */
            $questions = [];

            for ($i=1; $i<=$numberOfQuestions; $i++) {
                $questions[$i-1]['patientAnswer'.$i] = $request['patientAnswer'.$i];
                $questions[$i-1]['primaryQuestion'.$i] = $request['primaryQuestion'.$i];
                $questions[$i-1]['primaryKeywords'.$i] = json_decode($request['primaryKeywords'.$i], true);
                $questions[$i-1]['relatedQuestions'.$i] = json_decode($request['relatedQuestions'.$i], true);
            }


            // Instantiate the interactive case
            $interactiveCase = new InteractiveCase();
            $interactiveCase->interactive_case_name = $interactiveCaseName;
            $interactiveCase->time = $time;

            // Instantiate the virtual patient
            $virtualPatient = new Patient();
            $virtualPatient->gender = $patientGender;
            $virtualPatient->age = $patientAge;
            $virtualPatient->virtual_character = $virtualPatientPath;

            // link the interactive case with the virtual patient
            $interactiveCase->save();
            $interactiveCase->patient()->save($virtualPatient);

            /**
             * Work on the answers
             */
            for ($i=0; $i<$numberOfQuestions; $i++) {
                // Instantiate the answers
                $answerOfPatient = new AnswerOfPatient();
                $answerOfPatient->answer_body = $questions[$i]['patientAnswer'.($i+1)];
                $interactiveCase->answersOfPatient()->save($answerOfPatient);
                // Instantiate the primary question
                $primaryQuestion = new QuestionForPatient();
                $primaryOpenEndedQuestion = new OpenEnded();
                $primaryQuestion->isPrimary = true;
                $primaryQuestion->question_body = $questions[$i]['primaryQuestion'.($i+1)];

                // link the answer and the primary question
                $answerOfPatient->questionsForPatient()->save($primaryQuestion);

                // link the primary question to its open ended version
                $primaryOpenEndedQuestion->id = $primaryQuestion->id;
                $primaryOpenEndedQuestion->save();

                // Instantiate the primary keywords
                $numberOfPrimaryKeywords = count($questions[$i]['primaryKeywords'.($i+1)]);
                for ($j=0; $j<$numberOfPrimaryKeywords; $j++) {
                    $keyword = new Keyword();
                    $keyword->keyword_body = $questions[$i]['primaryKeywords'.($i+1)][$j]['text'];

                    // link keyword with question
                    $primaryOpenEndedQuestion->keywords()->save($keyword);
                }


                // Instantiate the related questions
                $numberOfRelatedQuestions = count($questions[$i]['relatedQuestions'.($i+1)]);
                for ($k=0; $k<$numberOfRelatedQuestions; $k++) {
                    // Instantiate a new related question
                    $relatedQuestion = new QuestionForPatient();
                    $relatedOpenEndedQuestion = new OpenEnded();
                    $relatedQuestion->isPrimary = false;
                    $relatedQuestion->question_body = $questions[$i]['relatedQuestions'.($i+1)][$k]['question'];

                    // link the related questions and the answer
                    $answerOfPatient->questionsForPatient()->save($relatedQuestion);

                    // link the question to its open ended version
                    $relatedOpenEndedQuestion->id = $relatedQuestion->id;
                    $relatedOpenEndedQuestion->save();


                    // Instantiate its keywords
                    $numberOfRlatedKeywords = count($questions[$i]['relatedQuestions'.($i+1)][$k]['keywords']);
                    for ($key=0; $key<$numberOfRlatedKeywords; $key++) {
                        $relatedKeyword = new Keyword();
                        $relatedKeyword->keyword_body = $questions[$i]['relatedQuestions'.($i+1)][$k]['keywords'][$key]['text'];
                        // link keyword with question
                        $relatedOpenEndedQuestion->keywords()->save($relatedKeyword);
                    }
                }

                // link the answer to the interactive case
                $interactiveCase->answersOfPatient()->save($answerOfPatient);
            }

            return 'OK.';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show(Request $request, $interactiveCaseID) {
        try {
            $interactiveCase = InteractiveCase::findOrFail($interactiveCaseID);
            $interactiveCaseName = $interactiveCase->interactive_case_name;
            $time = $interactiveCase->time;

            $virtualPatient = $interactiveCase->patient;
            $patintGender = $virtualPatient->gender;
            $patientAge = $virtualPatient->age;
            $virtualPatientPath = $virtualPatient->virtual_character;

            $answersOfPatient = $interactiveCase->answersOfPatient;
            $numberOfQuestions = count($answersOfPatient);
            $questions = array();
            for ($i = 0; $i < $numberOfQuestions; $i++) {
                $questions[$i]['patientAnswer'] = $answersOfPatient[$i]->answer_body;
                $questionsForPatient = $answersOfPatient[$i]->questionsForPatient;
                $n = count($questionsForPatient);
                $relatedQuestions = [];
                $k = 0;
                for ($j=0; $j<$n; $j++) {
                    if ($questionsForPatient[$j]->isPrimary) { // primary question
                        $questions[$i]['standardQuestion']['question_body'] = $questionsForPatient[$j]->question_body;
                        $id = $questionsForPatient[$j]->id;
                        $openEndedVersion = OpenEnded::findOrFail($id);
                        $questions[$i]['standardQuestion']['keywords'] = $openEndedVersion->keywords;
                    } else { // related questions
                        $questions[$i]['relatedQuestions'][$k]['question_body'] = $questionsForPatient[$j]->question_body;
                        $id = $questionsForPatient[$j]->id;
                        $openEndedVersion = OpenEnded::findOrFail($id);
                        $questions[$i]['relatedQuestions'][$k]['keywords'] = $openEndedVersion->keywords;
                        $k++;
                    }
                }
            }

            return json_encode(['interactiveCaseName' => $interactiveCaseName,
                                'patientGender' => $patintGender,
                                'patientAge' => $patientAge,
                                'patientCharacterPath' => $virtualPatientPath,
                                'numberOfQuestions' => $numberOfQuestions,
                                'time' => $time,
                                'questions' => json_encode($questions)]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
