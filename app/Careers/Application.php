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

    public function avatarName()
    {
        $avatar = $this->avatar()->first();

        return $avatar ? $this->createFileName($avatar->file_path, 'avatar') : null;
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

    public function coverLetterName()
    {
        $letter = $this->coverLetter()->first();

        return $letter ? $this->createFileName($letter->file_path, 'cover_letter') : null;
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

    public function resumeName()
    {
        $cv = $this->resume()->first();

        return $cv ? $this->createFileName($cv->file_path, 'cv') : null;
    }

    private function createFileName($original, $type)
    {
        $firstName = strtolower(preg_replace('/[^A-Za-z]/', '', $this->first_name));
        $lastName = strtolower(preg_replace('/[^A-Za-z]/', '', $this->last_name));
        $extension = collect(explode('.', $original))->last();

        return "{$firstName}_{$lastName}_{$type}.{$extension}";
    }


}
