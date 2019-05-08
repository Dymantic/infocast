<?php

namespace App\Http\Controllers\Admin;

use App\CaseStudies\CaseStudy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaseStudiesController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'title' => ['required'],
            'client' => [],
            'time_period' => [],
            'project_type' => []
        ]);
        return CaseStudy::create($data);
    }
}
