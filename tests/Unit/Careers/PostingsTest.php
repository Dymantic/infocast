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
     * @test
     */
    public function a_posting_can_be_published()
    {
        $posting = factory(Posting::class)->create(['published' => false]);
        $this->assertFalse($posting->published);

        $posting->publish();

        $this->assertTrue($posting->fresh()->published);
    }

    /**
     * @test
     */
    public function a_posting_can_be_retracted()
    {
        $posting = factory(Posting::class)->create(['published' => true]);
        $this->assertTrue($posting->published);

        $posting->retract();

        $this->assertFalse($posting->fresh()->published);
    }

    /**
     * @test
     */
    public function a_postings_application_field_settings_can_be_set()
    {
        $posting = factory(Posting::class)->create(['application_fields' => ['first_name' => 'required']]);

        $posting->setApplicationFields(['last_name' => 'hidden']);

        $this->assertEquals([
            'first_name' => 'required',
            'last_name'  => 'hidden'
        ], $posting->application_fields);
    }

    /**
     * @test
     */
    public function all_posting_application_fields_default_to_required_if_not_explicitly_set()
    {
        $posting = factory(Posting::class)->create();

        $this->assertEquals($this->getDefaultApplicationFields(), $posting->applicationFields());
    }

    /**
     * @test
     */
    public function a_postings_application_fields_are_correctly_returned()
    {
        $posting_application_fields = [
            'phone'  => Posting::FIELD_OPTIONAL,
            'gender' => Posting::FIELD_HIDDEN,
            'notes'  => Posting::FIELD_OPTIONAL
        ];
        $posting = factory(Posting::class)->create(['application_fields' => $posting_application_fields]);

        $expected = array_merge($this->getDefaultApplicationFields(), $posting_application_fields);

        $this->assertEquals($expected, $posting->applicationFields());
    }

    /**
     *@test
     */
    public function postings_scoped_to_live_are_published_and_have_a_past_posted_date()
    {
        $postingA = factory(Posting::class)->create(['posted' => Carbon::parse('-2 days'), 'published' => true]);
        $postingB = factory(Posting::class)->create(['posted' => Carbon::parse('-2 days'), 'published' => false]);
        $postingC = factory(Posting::class)->create(['posted' => Carbon::parse('+2 days'), 'published' => true]);
        $postingD = factory(Posting::class)->create(['posted' => Carbon::parse('+2 days'), 'published' => false]);

        $live_postings = Posting::live()->get();

        $this->assertCount(1, $live_postings);
        $this->assertTrue($live_postings->first()->is($postingA));
    }

    private function getDefaultApplicationFields()
    {
        return [
            'first_name'       => Posting::FIELD_REQUIRED,
            'last_name'        => Posting::FIELD_REQUIRED,
            'email'            => Posting::FIELD_REQUIRED,
            'phone'            => Posting::FIELD_REQUIRED,
            'contact_method'   => Posting::FIELD_REQUIRED,
            'gender'           => Posting::FIELD_REQUIRED,
            'date_of_birth'    => Posting::FIELD_REQUIRED,
            'prev_company'     => Posting::FIELD_REQUIRED,
            'prev_position'    => Posting::FIELD_REQUIRED,
            'university'       => Posting::FIELD_REQUIRED,
            'qualifications'   => Posting::FIELD_REQUIRED,
            'skills'           => Posting::FIELD_REQUIRED,
            'english_ability'  => Posting::FIELD_REQUIRED,
            'mandarin_ability' => Posting::FIELD_REQUIRED,
            'notes'            => Posting::FIELD_REQUIRED,
            'avatar'           => Posting::FIELD_REQUIRED,
            'cover_letter'     => Posting::FIELD_REQUIRED,
            'cv'               => Posting::FIELD_REQUIRED,
        ];
    }
}