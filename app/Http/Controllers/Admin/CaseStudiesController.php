<?php

namespace App\Http\Controllers\Admin;

use App\CaseStudies\CaseStudy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaseStudiesController extends Controller
{

    public function index()
    {
        return CaseStudy::latest()->get();
    }

    public function show(CaseStudy $study)
    {
        return $study;
    }

    public function edit(CaseStudy $study)
    {
        return view('admin.case-studies.edit', ['study' => $study->toArray()]);
    }

    public function store()
    {
        $data = request()->validate([
            'title' => ['required'],
            'client' => [],
            'time_period' => [],
            'project_type' => [],
            'intro' => [],
            'description' => [],
        ]);
        return CaseStudy::create($data);
    }

    public function update(CaseStudy $study)
    {
        request()->validate([
            'title' => ['required'],
            'client' => [],
            'time_period' => [],
            'project_type' => [],
            'intro' => [],
            'description' => [],
        ]);

        $updated_data = request()->only([
            'title',
            'client',
            'time_period',
            'project_type',
            'intro',
            'description',
        ]);

        $study->update($updated_data);

        return $study->fresh();
    }
}
