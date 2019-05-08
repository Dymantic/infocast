<?php

namespace App\Http\Controllers\Admin;

use App\CaseStudies\CaseStudy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaseStudyBodyController extends Controller
{
    public function update(CaseStudy $caseStudy)
    {
        $caseStudy->setBody(request('body'));
    }
}
