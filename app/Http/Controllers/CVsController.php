<?php

namespace App\Http\Controllers;

use App\Careers\ApplicationUpload;
use Illuminate\Http\Request;

class CVsController extends Controller
{
    public function store()
    {
        return ApplicationUpload::resume(request('cv'));
    }
}
