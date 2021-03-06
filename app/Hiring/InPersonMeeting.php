<?php

namespace App\Hiring;

use Illuminate\Database\Eloquent\Model;

class InPersonMeeting extends Model
{
    use GetsMarkedByUser;

    protected $fillable = ['met_on', 'marked_by', 'skipped'];

    protected $casts = ['skipped' => 'boolean'];

    protected $dates = ['met_on'];
}
