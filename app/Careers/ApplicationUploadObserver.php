<?php


namespace App\Careers;


use Illuminate\Support\Facades\Storage;

class ApplicationUploadObserver
{
    public function deleting(ApplicationUpload $upload)
    {
        Storage::disk(config('application_uploads.disk'))->delete($upload->file_path);
    }
}