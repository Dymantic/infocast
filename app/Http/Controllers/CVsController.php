<?php

namespace App\Http\Controllers;

use App\Careers\ApplicationUpload;
use Illuminate\Http\Request;

class CVsController extends Controller
{
    public function store()
    {
        request()->validate(['cv' => 'required|mimes:doc,docx,txt,pdf,zip|max:2048']);

        return ApplicationUpload::resume(request('cv'));
    }
}
