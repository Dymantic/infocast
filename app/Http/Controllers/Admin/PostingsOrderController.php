<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Posting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostingsOrderController extends Controller
{
    public function store()
    {
        request()->validate([
            'posting_order' => 'required|array',
            'posting_order.*' => 'exists:postings,id'
        ]);

        Posting::setOrder(request('posting_order'));
    }
}
