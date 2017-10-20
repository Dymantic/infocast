<?php

namespace Tests\Feature\Contact;

use App\Notifications\ContactMessageReceived;
use App\Secretary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ContactMessageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_contact_notification_is_sent()
    {
        $this->disableExceptionHandling();
        Notification::fake();

        $response = $this->json('POST', "/contact", [
            'first_name' => 'TEST FIRST NAME',
            'last_name'  => 'TEST LAST NAME',
            'email'      => 'TEST EMAIL',
            'phone'      => 'TEST PHONE',
            'inquiry'    => 'TEST MESSAGE',

        ]);
        $response->assertStatus(200);

        $secretary = app()->make('secretary');

        Notification::assertSentTo($secretary, ContactMessageReceived::class, function ($notification, $channels) {
            return $notification->message->first_name === 'TEST FIRST NAME' &&
                $notification->message->last_name === 'TEST LAST NAME' &&
                $notification->message->phone === 'TEST PHONE' &&
                $notification->message->email === 'TEST EMAIL' &&
                $notification->message->inquiry === 'TEST MESSAGE';
        });
    }
}