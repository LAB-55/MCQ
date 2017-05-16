<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MCQ extends Model
{
    protected $table = 'mcq';
    protected $fillable = ['question', 'answer', 'option1', 'option2', 'option3'];
 	protected $guarded = ['id'];
}
