<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DecidedCandidatesController extends Controller
{
    public function index()
    {
        $candidates = Candidate::decided()
                               ->latest()
                               ->paginate(15);

        return view('admin.candidates.index', ['candidates' => $candidates, 'group' => 'Decided']);
    }
}
