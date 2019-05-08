<?php

namespace Tests\Unit\CaseStudies;

use App\CaseStudies\CaseStudy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class CaseStudyTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function a_new_case_study_gets_a_slug()
    {
        $case_study = CaseStudy::create([
            'title' => 'test title',
            'client' => 'test client',
            'time_period' => 'test time',
            'project_type' => 'test project'
        ]);

        $this->assertEquals('test-title', $case_study->fresh()->slug);
    }

    /**
     *@test
     */
    public function updated_a_never_published_case_study_will_update_the_slug()
    {
        $case_study = CaseStudy::create([
            'title' => 'first test title',
            'client' => 'test client',
            'time_period' => 'test time',
            'project_type' => 'test project'
        ]);

        $this->assertEquals('first-test-title', $case_study->fresh()->slug);
        $this->assertFalse($case_study->hasBeenPublished());

        $case_study->update(['title' => 'second test title']);

        $this->assertEquals('second-test-title', $case_study->fresh()->slug);
    }

    /**
     *@test
     */
    public function slug_of_published_case_study_does_not_update()
    {
        $case_study = CaseStudy::create([
            'title' => 'first test title',
            'client' => 'test client',
            'time_period' => 'test time',
            'project_type' => 'test project',

        ]);

        $case_study->published_on = Carbon::today();
        $case_study->save();

        $this->assertEquals('first-test-title', $case_study->fresh()->slug);
        $this->assertTrue($case_study->fresh()->hasBeenPublished());

        $case_study->update(['title' => 'second test title']);

        $this->assertEquals('first-test-title', $case_study->fresh()->slug);
    }

    /**
     *@test
     */
    public function a_case_study_with_a_null_published_on_date_has_never_been_published()
    {
        $case_study = CaseStudy::create([
            'title' => 'first test title',
            'client' => 'test client',
            'time_period' => 'test time',
            'project_type' => 'test project'
        ]);

        $this->assertNull($case_study->fresh()->published_on);
        $this->assertFalse($case_study->hasBeenPublished());

        $case_study->published_on = Carbon::today();
        $case_study->save();

        $this->assertTrue($case_study->fresh()->hasBeenPublished());
    }

    /**
     *@test
     */
    public function starts_out_as_draft()
    {
        $case_study = CaseStudy::create([
            'title' => 'first test title',
            'client' => 'test client',
            'time_period' => 'test time',
            'project_type' => 'test project'
        ]);

        $this->assertTrue($case_study->fresh()->is_draft);
    }

    /**
     *@test
     */
    public function can_be_published()
    {
        $case_study = CaseStudy::create([
            'title' => 'first test title',
            'client' => 'test client',
            'time_period' => 'test time',
            'project_type' => 'test project'
        ]);

        $this->assertFalse($case_study->hasBeenPublished());

        $case_study->publish();

        $this->assertTrue($case_study->fresh()->hasBeenPublished());
        $this->assertFalse($case_study->fresh()->is_draft);
    }

    /**
     *@test
     */
    public function can_be_retracted()
    {
        $case_study = CaseStudy::create([
            'title' => 'first test title',
            'client' => 'test client',
            'time_period' => 'test time',
            'project_type' => 'test project'
        ]);

        $case_study->publish();
        $this->assertTrue($case_study->fresh()->hasBeenPublished());
        $this->assertFalse($case_study->fresh()->is_draft);

        $case_study->retract();
        $this->assertTrue($case_study->fresh()->is_draft);

    }

    /**
     *@test
     */
    public function body_can_be_set()
    {
        $case_study = factory(CaseStudy::class)->create(['body' => '']);

        $case_study->setBody('this is the body');

        $this->assertEquals('this is the body', $case_study->fresh()->body);
    }
}