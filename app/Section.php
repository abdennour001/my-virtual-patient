<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table='sections';
    protected $primaryKey='id';
    protected $fillable=['section_number', 'path_excel_sheet'];

    /**
     * Get the Session that owns the interactive case.
     */
    public function sessions()
    {
        return $this->hasMany('App\Session');
    }
}
