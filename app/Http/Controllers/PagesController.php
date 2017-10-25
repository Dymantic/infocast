<?php

namespace App\Http\Controllers;

use App\Careers\Posting;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $postings = Posting::live()->latest()->take(4)->get();
        return view('front.home.page', ['postings' => $postings]);
    }

    public function thanks()
    {
        return view('front.thanks', ['name' => request('name')]);
    }
}
