<?php

namespace App\Http\Controllers\Admin;

use App\CaseStudies\CaseStudy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaseStudyBodyImagesController extends Controller
{
    public function store(CaseStudy $caseStudy)
    {
        request()->validate(['image' => ['required', 'file', 'image']]);

        $image = $caseStudy->addBodyImage(request('image'));

        return ['location' => $image->getUrl('web')];
    }
}
