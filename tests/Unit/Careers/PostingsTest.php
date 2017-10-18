<?php

namespace Tests\Unit\Careers;

use App\Careers\Application;
use App\Careers\Posting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class PostingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_posting_can_receive_an_application()
    {
        $posting = factory(Posting::class)->create();
        $application_details = [
            'first_name'       => 'TEST FIRST NAME',
            'last_name'        => 'TEST LAST NAME',
            'email'            => 'TEST EMAIL',
            'phone'            => 'TEST PHONE',
            'contact_method'   => 'phone',
            'gender'           => 'female',
            'date_of_birth'    => '01/01/1980',
            'prev_company'     => 'TEST COMPANY',
            'prev_position'    => 'TEST POSITION',
            'university'       => 'TEST UNIVERSITY',
            'qualifications'   => 'TEST QUALIFICATIONS',
            'skills'           => 'TEST SKILLS',
            'english_ability'  => 'excellent',
            'mandarin_ability' => 'poor',
            'notes'            => 'TEST NOTES'
        ];

        $posting->receiveApplication($application_details);

        $this->assertCount(1, $posting->fresh()->applications);
        $application = $posting->fresh()->applications->first();
        $this->assertInstanceOf(Application::class, $application);

        $this->assertEquals('TEST FIRST NAME', $application->first_name);
        $this->assertEquals('TEST LAST NAME', $application->last_name);
        $this->assertEquals('TEST EMAIL', $application->email);
        $this->assertEquals('TEST PHONE', $application->phone);
        $this->assertEquals('phone', $application->contact_method);
        $this->assertEquals('female', $application->gender);
        $this->assertEquals('01/01/1980', $application->date_of_birth);
        $this->assertEquals('TEST COMPANY', $application->prev_company);
        $this->assertEquals('TEST POSITION', $application->prev_position);
        $this->assertEquals('TEST UNIVERSITY', $application->university);
        $this->assertEquals('TEST QUALIFICATIONS', $application->qualifications);
        $this->assertEquals('TEST SKILLS', $application->skills);
        $this->assertEquals('excellent', $application->english_ability);
        $this->assertEquals('poor', $application->mandarin_ability);
        $this->assertEquals('TEST NOTES', $application->notes);

    }

    /**
     * @test
     */
    public function a_posting_may_be_presented_as_a_jsonable_array()
    {
        $posting = factory(Posting::class)->create([
            'title'            => 'TEST TITLE',
            'type'             => 'TEST TYPE',
            'category'         => 'TEST CATEGORY',
            'location'         => 'TEST LOCATION',
            'compensation'     => 'TEST COMPENSATION',
            'posted'           => Carbon::today(),
            'start_date'       => 'TEST START DATE',
            'introduction'     => 'TEST INTRODUCTION',
            'job_description'  => 'TEST JOB DESCRIPTION',
            'responsibilities' => 'TEST RESPONSIBILITIES',
            'requirements'     => 'TEST REQUIREMENTS'
        ]);

        $expected = [
            'id'               => $posting->id,
            'title'            => 'TEST TITLE',
            'type'             => 'TEST TYPE',
            'category'         => 'TEST CATEGORY',
            'location'         => 'TEST LOCATION',
            'compensation'     => 'TEST COMPENSATION',
            'posted'           => Carbon::today()->format('Y-m-d'),
            'start_date'       => 'TEST START DATE',
            'introduction'     => 'TEST INTRODUCTION',
            'job_description'  => 'TEST JOB DESCRIPTION',
            'responsibilities' => 'TEST RESPONSIBILITIES',
            'requirements'     => 'TEST REQUIREMENTS'
        ];

        $this->assertEquals($expected, $posting->toJsonableArray());
    }

    /**
     *@test
     */
    public function a_posting_can_be_published()
    {
        $posting = factory(Posting::class)->create(['published' => false]);
        $this->assertFalse($posting->published);

        $posting->publish();

        $this->assertTrue($posting->fresh()->published);
    }

    /**
     *@test
     */
    public function a_posting_can_be_retracted()
    {
        $posting = factory(Posting::class)->create(['published' => true]);
        $this->assertTrue($posting->published);

        $posting->retract();

        $this->assertFalse($posting->fresh()->published);
    }
}