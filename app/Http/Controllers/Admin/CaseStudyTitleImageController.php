<?php

namespace App\Http\Controllers\Admin;

use App\CaseStudies\CaseStudy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaseStudyTitleImageController extends Controller
{
    public function store(CaseStudy $caseStudy)
    {
        $upload = request()->validate([
            'image' => ['required', 'image']
        ]);
        $image = $caseStudy->setTitleImage($upload['image']);

        return ['image_src' => $image->getFullUrl()];
    }

    public function destroy(CaseStudy $caseStudy)
    {
        $caseStudy->clearTitleImage();
    }
}
