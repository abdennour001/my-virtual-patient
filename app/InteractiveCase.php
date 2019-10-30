<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InteractiveCase extends Model
{
    protected $table='interactive_cases';
    protected $primaryKey='id';
    protected $fillable=['interactive_case_name', 'time'];


    /**
     * Get the Sessions that contains the interactive case.
     */
    public function sessions()
    {
        return $this->hasMany('App\Session');
    }

    /**
     * Get the patient associated with the interactive case.
     */
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    /**
     * Get the answers of the patient associated with the interactive case.
     */
    public function answersOfPatient()
    {
        return $this->hasMany(AnswerOfPatient::class);
    }
}
