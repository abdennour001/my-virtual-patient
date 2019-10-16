<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClosedEnded extends Model
{
    protected $table='closed_ended';
    protected $primaryKey='id';
    protected $fillable=['id'];

    /**
     * Get the options associated with the closed ended question.
     */
    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
