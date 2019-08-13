<?php

namespace App\Hiring;

use Illuminate\Database\Eloquent\Model;

class ReferenceCheck extends Model
{
    use GetsMarkedByUser;

    protected $fillable = ['checked_on', 'marked_by', 'skipped'];

    protected $casts = ['skipped' => 'boolean'];

    protected $dates = ['checked_on'];
}
