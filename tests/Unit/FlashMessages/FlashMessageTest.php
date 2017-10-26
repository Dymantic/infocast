<?php

namespace Tests\Unit\FlashMessages;

use Flash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FlashMessageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_success_message_can_be_flashed_to_the_session()
    {
        Flash::success('Title', 'text');

        $expected = [
            'icon'   => 'success',
            'title'  => 'Title',
            'text'   => 'text',
            'timer'  => 2000,
            'button' => false
        ];

        $this->assertEquals($expected, session('flash_message'));
    }

    /**
     *@test
     */
    public function an_error_message_may_be_flashed_to_the_session()
    {
        Flash::error('Title', 'text');

        $expected = [
            'icon'   => 'error',
            'title'  => 'Title',
            'text'   => 'text',
            'timer'  => 2000,
            'button' => false
        ];

        $this->assertEquals($expected, session('flash_message'));
    }
}