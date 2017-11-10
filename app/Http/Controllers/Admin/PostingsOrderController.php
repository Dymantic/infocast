<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Posting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostingsOrderController extends Controller
{

    public function show()
    {
        $postings = Posting::all()->map(function($posting) {
            return [
                'id' => $posting->id,
                'name' => $posting->title,
                'position' => $posting->position ?? 999
            ];
        });
        return view('admin.postings.order.show', ['postings' => $postings]);
    }

    public function store()
    {
        request()->validate([
            'posting_order' => 'required|array',
            'posting_order.*' => 'exists:postings,id'
        ]);

        Posting::setOrder(request('posting_order'));
    }
}
