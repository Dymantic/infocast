<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CandidateStatusController extends Controller
{
    public function show(Candidate $candidate)
    {
        return $candidate->status();
    }
}
