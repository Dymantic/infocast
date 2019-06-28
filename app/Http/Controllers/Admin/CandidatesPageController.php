<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CandidatesPageController extends Controller
{
    public function index()
    {
        $candidates = Candidate::latest()->get();
        return view('admin.candidates.index', ['candidates' => $candidates]);
    }

    public function show(Candidate $candidate)
    {
        return view('admin.candidates.show', ['candidate' => $candidate->toArray()]);
    }
}
