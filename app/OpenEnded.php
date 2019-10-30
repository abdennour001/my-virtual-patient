<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpenEnded extends Model
{
    protected $table='open_ended';
    protected $primaryKey='id';
    public $incrementing = false;
    protected $fillable=['id'];

    /**
     * Get the keywords associated with the open ended question.
     */
    public function keywords()
    {
        return $this->hasMany(Keyword::class, 'open_ended_id', 'id');
    }
}
