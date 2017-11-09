<?php


namespace App\Careers;


use App\Notifications\ApplicationReceived;
use Illuminate\Support\Facades\Notification;

class ApplicationObserver
{
    public function created(Application $application)
    {
        $secretary = app()->make('secretary');
        $post = $application->posting ? $application->posting->title : '[POST DELETED]';

        Notification::send($secretary, new ApplicationReceived($application, $post));
    }
}