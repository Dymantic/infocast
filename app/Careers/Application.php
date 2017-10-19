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

    public function avatar()
    {
        return $this->belongsTo(ApplicationUpload::class, 'avatar');
    }

    public function avatarUrl()
    {
        $avatar = $this->avatar()->first();

        return $avatar ? '/application_uploads/' . $avatar->file_path : null;
    }

    public function coverLetter()
    {
        return $this->belongsTo(ApplicationUpload::class, 'cover_letter');
    }

    public function coverLetterUrl()
    {
        $letter = $this->coverLetter()->first();

        return $letter ? '/application_uploads/' . $letter->file_path : null;
    }

    public function resume()
    {
        return $this->belongsTo(ApplicationUpload::class, 'cv');
    }

    public function resumeUrl()
    {
        $cv = $this->resume()->first();

        return $cv ? '/application_uploads/' . $cv->file_path : null;
    }
}
