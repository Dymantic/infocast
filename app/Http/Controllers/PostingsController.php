<?php

namespace App\Http\Controllers;

use App\Careers\Posting;
use Illuminate\Http\Request;

class PostingsController extends Controller
{
    public function index()
    {
        $postings = Posting::live()->ordered()->get();
        return view('front.careers.page', ['postings' => $postings]);
    }

    public function show(Posting $posting)
    {
        return view('front.job-posts.page', ['posting' => $posting]);
    }
}
