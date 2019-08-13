<?php

namespace App\Hiring;

use Illuminate\Database\Eloquent\Model;

class AptitudeTest extends Model
{
    use GetsMarkedByUser;

    protected $fillable = ['tested_on', 'marked_by', 'skipped'];

    protected $casts = ['skipped' => 'boolean'];

    protected $dates = ['tested_on'];
}
