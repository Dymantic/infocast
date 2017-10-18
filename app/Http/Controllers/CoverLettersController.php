<?php

namespace App\Http\Controllers;

use App\Careers\ApplicationUpload;
use Illuminate\Http\Request;

class CoverLettersController extends Controller
{
    public function store()
    {
        request()->validate(['cover_letter' => 'required|mimes:doc,docx,txt,pdf|max:2048']);

        return ApplicationUpload::coverLetter(request('cover_letter'));
    }
}
