<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AptitudeTestController extends Controller
{
    public function store(Candidate $candidate)
    {
        request()->validate(['tested_on' => 'date']);

        if(request('skipped', false)) {
            $candidate->skipAptitudeTest(request()->user());
        }

        return $candidate->passedAptitudeTest(request('tested_on'), request()->user());
    }
}
