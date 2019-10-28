<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerOfPatient extends Model
{
    protected $table='answer_of_patients';
    protected $primaryKey='id';
    protected $fillable=['answer_body', 'voice_record'];

    /**
     * Get the interactive case associated with the answer of the patient.
     */
    public function interactiveCase()
    {
        return $this->belongsTo('App\InteractiveCase', 'interactive_case_id');
    }


    /**
     * Get the question associated with the answer.
     */
    public function questionsForPatient()
    {
        return $this->hasMany(QuestionForPatient::class);
    }
}
