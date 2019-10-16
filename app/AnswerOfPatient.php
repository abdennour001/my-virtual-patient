<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerOfPatient extends Model
{
    protected $table='answer_of_patients';
    protected $primaryKey='id';
    protected $fillable=['answer_body', 'voice_record'];

    /**
     * Get the question associated with the answer.
     */
    public function questionForPatient()
    {
        return $this->belongsTo(QuestionForPatient::class, 'question_for_patient_id');
    }
}
