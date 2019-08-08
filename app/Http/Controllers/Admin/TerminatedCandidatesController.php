<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TerminatedCandidatesController extends Controller
{
    public function store(Candidate $candidate)
    {
        $candidate->terminate(request('terminated_by'), request('reason'));
    }
}
