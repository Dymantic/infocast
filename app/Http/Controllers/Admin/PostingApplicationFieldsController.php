<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Posting;
use App\Http\Requests\PostingApplicationFieldsForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class PostingApplicationFieldsController extends Controller
{
    public function update(Posting $posting, PostingApplicationFieldsForm $form)
    {
        $posting->setApplicationFields($form->updatedFields());

        return $posting->fresh()->applicationFields();
    }
}
