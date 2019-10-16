<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table='options';
    protected $primaryKey='id';
    protected $fillable=['option_body', 'correct'];

    /**
     * Get the question associated with the option.
     */
    public function closedEnded()
    {
        return $this->belongsTo(ClosedEnded::class, 'closed_ended_id');
    }
}
