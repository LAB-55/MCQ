<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module_Id extends Model
{
    protected $table = 'module_id';
    protected $fillable = ['moduleid', 'subjectid', 'modulename'];
 	protected $guarded = ['id'];
}
