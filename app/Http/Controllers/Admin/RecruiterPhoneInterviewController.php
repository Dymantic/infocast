<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecruiterPhoneInterviewController extends Controller
{
    public function store(Candidate $candidate)
    {
        request()->validate(['interviewed_on' => 'date']);

        if(request('skipped', false)) {
            return $candidate->skipRecruiterPhoneInterview(request()->user());
        }
//        $interview_date = request('interviewed_on', null);
        return $candidate->recruiterPhoneInterviewDone(request('interviewed_on'), request()->user());
    }
}
