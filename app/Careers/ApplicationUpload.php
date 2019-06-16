<?php

namespace App\Careers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Ramsey\Uuid\Uuid;

class ApplicationUpload extends Model
{
    protected $fillable = ['file_id', 'file_path', 'file_type'];

    public static function avatar(UploadedFile $image)
    {
        $path = $image->store('avatars', config('app.application_uploads.disk'));

        return static::makeFile($path, 'avatar');
    }

    public static function coverLetter(UploadedFile $file)
    {
        $path = $file->store('covers_letters', config('app.application_uploads.disk'));

        return static::makeFile($path, 'cover_letter');
    }

    public static function resume(UploadedFile $file)
    {
        $path = $file->store('cvs', config('app.application_uploads.disk'));

        return static::makeFile($path, 'cv');
    }

    public static function byFileId($file_id)
    {
        return static::where('file_id', $file_id)->firstOrFail();
    }

    private static function makeFile($path, $type)
    {
        return static::create([
            'file_id'   => Uuid::uuid4()->toString(),
            'file_path' => $path,
            'file_type' => $type
        ]);
    }

    public function belongsToSubmittedApplication()
    {
        return !! Application::where($this->file_type, $this->id)->first();
    }

    public function belongsToCandidate()
    {
        if($this->file_type === 'cv') {
            return !! Candidate::where('resume_id', $this->id)->first();
        }

        if($this->file_type === 'cover_letter') {
            return !! Candidate::where('cover_letter_id', $this->id)->first();
        }

        return false;
    }
}
