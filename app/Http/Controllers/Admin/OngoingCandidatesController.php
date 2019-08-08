<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OngoingCandidatesController extends Controller
{
    public function index()
    {
        $candidates = Candidate::ongoing()
                               ->latest()
                               ->paginate(15);

        return view('admin.candidates.index', ['candidates' => $candidates, 'group' => 'Ongoing']);
    }
}
