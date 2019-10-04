<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CandidateDeadlineController extends Controller
{
    public function store(Candidate $candidate)
    {
        request()->validate(['deadline' => ['date', 'after_or_equal:today']]);
        $candidate->setDeadline(request('deadline'));
    }
}
