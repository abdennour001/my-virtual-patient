<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table='patients';
    protected $primaryKey='id';
    protected $fillable=['gender', 'age', 'condition', 'injury_type', 'facial_expression',
        'nonverbal_expression', 'virtual_character'];

    /**
     * Get the interactive case associated with the patient.
     */
    public function interactiveCase()
    {
        return $this->belongsTo(InteractiveCase::class, 'interactive_case_id');
    }
}
