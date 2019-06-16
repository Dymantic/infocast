<?php

namespace App\Hiring;

use Illuminate\Database\Eloquent\Model;

class RecruiterPhoneInterview extends Model
{
    protected $fillable = ['interviewed_on', 'marked_by', 'skipped'];

    protected $casts = ['skipped' => 'boolean'];

    protected $dates = ['interviewed_on'];
}
