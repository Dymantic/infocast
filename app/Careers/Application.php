<?php

namespace App\Careers;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasApplicationDocuments;

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



    public function track()
    {
        return $this->candidate()->create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'cover_letter' => $this->cover_letter,
            'cv' => $this->cv,
            'position' => $this->posting->title,
        ]);
    }

    public function candidate()
    {
        return $this->hasOne(Candidate::class);
    }

    public function isTracked()
    {
        return !! $this->candidate;
    }


}
