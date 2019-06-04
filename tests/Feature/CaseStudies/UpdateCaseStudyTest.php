<?php


namespace Tests\Feature\CaseStudies;


use App\CaseStudies\CaseStudy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateCaseStudyTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function an_existing_case_study_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $study = factory(CaseStudy::class)->create();

        $response = $this->asLoggedInUser()->postJson("/admin/case-studies/{$study->id}", [
            'title' => 'new title',
            'time_period' => 'new time period',
            'project_type' => 'new project type',
            'client' => 'new client',
            'intro' => 'new intro',
            'description' => 'new description',
            'body' => 'test body content'
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('case_studies', [
            'title' => 'new title',
            'time_period' => 'new time period',
            'project_type' => 'new project type',
            'client' => 'new client',
            'intro' => 'new intro',
            'description' => 'new description',
            'body' => 'test body content'
        ]);
    }
}