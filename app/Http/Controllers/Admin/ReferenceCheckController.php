<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReferenceCheckController extends Controller
{
    public function store(Candidate $candidate)
    {
        request()->validate(['checked_on' => 'date']);

        if(request('skipped', false)) {
            return $candidate->skipReferenceCheck(request()->user());
        }

        return $candidate->referenceCheckOkay(request('checked_on'), request()->user());
    }
}
