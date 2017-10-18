<?php

namespace App\Http\Controllers;

use App\Careers\ApplicationUpload;
use App\Careers\Posting;
use App\Http\Requests\ApplicationForm;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function store(Posting $posting, ApplicationForm $form)
    {
        $posting->receiveApplication($form->fields());
    }
}
