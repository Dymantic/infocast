<?php

namespace App\Hiring;

use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use GetsMarkedByUser;

    protected $fillable = ['marked_by', 'skipped', 'offered_on'];

    protected $casts = ['skipped' => 'boolean'];

    protected $dates = ['offered_on'];
}
