<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject_Id extends Model
{
	protected $table = 'subject_id';
    protected $fillable = ['subjectid', 'subjectname']; 
}
