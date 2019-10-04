<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobOffersController extends Controller
{
    public function store(Candidate $candidate)
    {
        request()->validate([
            'offered_on' => ['date']
        ]);

        if(request('skipped', false)) {
            return $candidate->skipJobOffer(request()->user());
        }

        return $candidate->offerJob(request('offered_on'), request()->user());
    }
}
