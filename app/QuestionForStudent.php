<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionForStudent extends Model
{
    protected $table='question_for_students';
    protected $primaryKey='id';
    protected $fillable=['question_body'];

    /**
     * Get the interactive case associated with the question for student.
     */
    public function interactiveCase()
    {
        return $this->belongsTo('App\InteractiveCase', 'interactive_case_id');
    }
}
