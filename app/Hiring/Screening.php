<?php

namespace App\Hiring;

use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    protected $fillable = ['marked_by', 'screened_on', 'skipped'];

    protected $dates = ['screened_on'];

    protected $casts = ['skipped' => 'bool'];
}
