<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table='section';
    protected $primaryKey = 'sectionID';
    protected $fillable=['section_number', 'path_excel_sheet', 'sectionID','section_name', 'studentIDs','instructor_section_id',];

    /**
     * Get the Session that owns the interactive case.
     */
    public function sessions()
    {
        return $this->hasMany('App\Session');
    }
}
