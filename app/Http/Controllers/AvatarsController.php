<?php

namespace App\Http\Controllers;

use App\Careers\ApplicationUpload;
use Illuminate\Http\Request;

class AvatarsController extends Controller
{
    public function store()
    {
        request()->validate(['avatar' => 'required|image|max:2048']);

        return ApplicationUpload::avatar(request('avatar'));
    }
}
