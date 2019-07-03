<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Application;
use App\Careers\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CandidatesController extends Controller
{
    public function store()
    {
        $application = Application::findOrFail(request('application_id'));

        $application->track();

        return redirect('/admin/candidates-tracking/ongoing');
    }
}
