<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupervisorPhoneInterviewController extends Controller
{
    public function store(Candidate $candidate)
    {
        request()->validate(['interviewed_on' => 'date']);

        if(request('skipped', false)) {
            return $candidate->skipSupervisorPhoneInterview(request()->user());
        }

        return $candidate->supervisorPhoneInterviewDone(request('interviewed_on'), request()->user());
    }
}
