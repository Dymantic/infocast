<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicationsController extends Controller
{

    public function index()
    {
        $applications = Application::with('posting')->latest()->get();

        return view('admin.applications.index', ['applications' => $applications]);
    }

    public function show(Application $application)
    {
        $application->load('posting');
        return view('admin.applications.show', ['application' => $application]);
    }
}
