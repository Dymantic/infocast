<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScreenedCandidatesController extends Controller
{
    public function store(Candidate $candidate)
    {
        request()->validate(['screened_on' => 'date']);

        if(request('skipped', false)) {
            return $candidate->skipScreening(request()->user());
        }

        return $candidate->markAsScreened(request('screened_on'), request()->user());
    }
}
