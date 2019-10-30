<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionForPatient extends Model
{
    protected $table='question_for_patients';
    protected $primaryKey='id';
    protected $fillable=['question_body', 'isPrimary'];

    /**
     * Get the answer of this question.
     */
    public function answerOfPatient()
    {
        return $this->belongsTo(AnswerOfPatient::class, 'answer_of_patient_id');
    }
}
