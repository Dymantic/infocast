<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Posting;
use App\Http\Requests\PostingForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostingsController extends Controller
{

    public function index()
    {
        return view('admin.postings.index', ['postings' => Posting::with('applications')->withCount('applications')->get()]);
    }

    public function show(Posting $posting)
    {
        $posting->load('applications');
        return view('admin.postings.show', ['posting' => $posting]);
    }

    public function create()
    {
        return view('admin.postings.create');
    }

    public function edit(Posting $posting)
    {
        return view('admin.postings.edit', ['posting' => $posting]);
    }

    public function store(PostingForm $form)
    {
        Posting::create($form->fields());
    }

    public function update(Posting $posting, PostingForm $form)
    {
        $posting->update($form->fields());

        return $posting->fresh()->toJsonableArray();
    }

    public function delete(Posting $posting)
    {
        $posting->delete();
        return redirect('/admin/postings');
    }
}
