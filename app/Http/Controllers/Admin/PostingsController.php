<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Posting;
use App\FlashMessaging\Flash;
use App\Http\Requests\PostingForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostingsController extends Controller
{

    public function index()
    {
        $postings = Posting::with('applications')->withCount('applications')->latest()->paginate(15);
        return view('admin.postings.index', ['postings' => $postings]);
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

        Flash::success('New Post Created', 'Best of luck!');
    }

    public function update(Posting $posting, PostingForm $form)
    {
        $posting->update($form->fields());

        Flash::success('Posting updated', 'Your changes have been saved');

        return $posting->fresh()->toJsonableArray();
    }

    public function delete(Posting $posting)
    {
        $posting->delete();

        Flash::success('Posting deleted', 'The posting is no longer on the system.');

        return redirect('/admin/postings');
    }
}
