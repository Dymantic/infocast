<?php


namespace App\Careers;


trait HasApplicationDocuments
{
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