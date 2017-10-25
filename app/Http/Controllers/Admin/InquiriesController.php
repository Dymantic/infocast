<?php

namespace App\Http\Controllers\Admin;

use App\Contact\ContactMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InquiriesController extends Controller
{
    public function index()
    {
        $inquiries = ContactMessage::latest()->paginate(10);

        return view('admin.inquiries.index', ['inquiries' => $inquiries]);
    }

    public function delete(ContactMessage $message)
    {
        $message->delete();

        return redirect('/admin/inquiries');
    }
}
