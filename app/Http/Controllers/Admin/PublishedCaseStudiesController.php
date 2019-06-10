<?php

namespace App\Http\Controllers\Admin;

use App\CaseStudies\CaseStudy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublishedCaseStudiesController extends Controller
{
    public function store()
    {

        $case_study = CaseStudy::findOrFail(request('case_study_id'));

        $case_study->publish();

        return $case_study->fresh();
    }

    public function destroy(CaseStudy $caseStudy)
    {
        $caseStudy->retract();

        return $caseStudy->fresh();
    }
}
