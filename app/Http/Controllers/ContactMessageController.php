<?php

namespace App\Http\Controllers;

use App\Contact\ContactMessage;
use App\Notifications\ContactMessageReceived;
use App\Secretary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactMessageController extends Controller
{

    public function create()
    {
        return view('front.contact.page');
    }

    public function store()
    {
        request()->validate([
            'first_name' => 'required_without:last_name|max:255',
            'last_name' => 'required_without:first_name|max:255',
            'phone' => 'required_without:email|max:255',
            'email' => 'required_without:phone|max:255',
            'inquiry' => 'required'
        ]);
        $message = ContactMessage::create(request()->all());

        $secretary = app()->make('secretary');

        Notification::send($secretary, new ContactMessageReceived($message));

        $name = urlencode("{$message->first_name} {$message->last_name}");

        return ['redirect_url' => "/thank-you?name={$name}&type=inquiry"];
    }
}
