<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table='sessions';
    protected $primaryKey='id';
    protected $fillable=['session_name'];

    /**
     * Get the interactive case associated with the session.
     */
    public function interactiveCase()
    {
        return $this->belongsTo('App\InteractiveCase', 'interactive_case_id');
    }

    /**
     * Get the section associated with the session.
     */
    public function section()
    {
        return $this->belongsTo('App\Section', 'section_id');
    }
}
