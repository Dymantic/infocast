<?php

namespace App\Http\Controllers\Admin;

use App\Careers\Application;
use App\FlashMessaging\Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicationsController extends Controller
{

    public function index()
    {
        $applications = Application::with('posting')->latest()->paginate(15);

        return view('admin.applications.index', ['applications' => $applications]);
    }

    public function show(Application $application)
    {
        $application->load('posting');
        return view('admin.applications.show', ['application' => $application]);
    }

    public function delete(Application $application)
    {
        $application->delete();

        Flash::success('Application deleted', 'That is one less thing to worry about.');

        return redirect('/admin/applications');
    }
}
