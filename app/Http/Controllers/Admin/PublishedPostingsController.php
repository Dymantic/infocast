<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Posting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublishedPostingsController extends Controller
{
    public function store()
    {
        request()->validate(['posting_id' => 'required|integer|exists:postings,id']);

        Posting::findOrFail(request('posting_id'))->publish();
    }

    public function delete(Posting $posting)
    {
        $posting->retract();
    }
}
