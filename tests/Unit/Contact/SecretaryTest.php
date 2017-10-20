<?php

namespace Tests\Unit\Contact;


use App\Secretary;
use Tests\TestCase;

class SecretaryTest extends TestCase
{
    /**
     *@test
     */
    public function the_secretary_is_properly_provided_by_the_container()
    {
        $secretary = app()->make('secretary');

        $this->assertEquals(config('contact.general_email'), $secretary->email);

        $this->assertEquals(config('contact.slack'), $secretary->routeNotificationForSlack());
    }
}