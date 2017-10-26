<?php


namespace App\FlashMessaging;


use Illuminate\Support\ServiceProvider;

class FlashMessengerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('flash-messenger', function() {
           return new FlashMessenger();
        });
    }
}