<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FinalisedCandidatesController extends Controller
{
    public function store(Candidate $candidate)
    {
        request()->validate([
            'accepted' => ['required', 'boolean']
        ]);

        $candidate->finalise(request('accepted'));
    }
}
