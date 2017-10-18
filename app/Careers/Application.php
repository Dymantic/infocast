<?php

namespace App\Careers;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'contact_method',
        'gender',
        'date_of_birth',
        'prev_company',
        'prev_position',
        'university',
        'qualifications',
        'skills',
        'english_ability',
        'mandarin_ability',
        'notes',
        'avatar',
        'cover_letter',
        'cv'
    ];

    public function posting()
    {
        return $this->belongsTo(Posting::class);
    }
}
