<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionForPatient extends Model
{
    protected $table='question_for_patients';
    protected $primaryKey='id';
    protected $fillable=['question_body'];

    /**
     * Get the interactive case associated with the question for patient.
     */
    public function interactiveCase()
    {
        return $this->belongsTo('App\InteractiveCase', 'interactive_case_id');
    }

    /**
     * Get the answer associated with the question.
     */
    public function answerOfPatient()
    {
        return $this->hasOne(AnswerOfPatient::class);
    }
}
