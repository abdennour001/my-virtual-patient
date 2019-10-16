<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $table='keywords';
    protected $primaryKey='id';
    protected $fillable=['keyword_body'];

    /**
     * Get the open ended associated with the keyword.
     */
    public function openEnded()
    {
        return $this->belongsTo(OpenEnded::class, 'open_ended_id');
    }
}
