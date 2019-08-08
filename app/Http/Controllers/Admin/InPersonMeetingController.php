<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InPersonMeetingController extends Controller
{
    public function store(Candidate $candidate)
    {
        request()->validate(['met_on' => 'date']);
        
        if(request('skipped', false)) {
            return $candidate->skipInPersonMeeting(request()->user());
        }

        return $candidate->inPersonMeetingDone(request('met_on'), request()->user());
    }
}
