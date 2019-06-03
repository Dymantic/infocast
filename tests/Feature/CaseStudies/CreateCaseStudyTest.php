<?php

namespace Tests\Feature\CaseStudies;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateCaseStudyTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function create_a_case_study()
    {
        $this->withoutExceptionHandling();

        $response = $this->asLoggedInUser()->postJson("/admin/case-studies", [
            'title' => 'test title',
            'client' => 'test client',
            'time_period' => 'test time',
            'project_type' => 'test project',
            'intro' => 'test intro',
            'description' => 'test description'
        ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('case_studies', [
            'title' => 'test title',
            'client' => 'test client',
            'time_period' => 'test time',
            'project_type' => 'test project',
            'intro' => 'test intro',
            'description' => 'test description',
            'body' => null
        ]);
    }

    /**
     *@test
     */
    public function the_title_is_required()
    {

        $response = $this->asLoggedInUser()->postJson("/admin/case-studies", [
            'title' => '',
            'client' => 'test client',
            'time_period' => 'test time',
            'project_type' => 'test project'
        ]);
        $response->assertStatus(422);

        $response->assertJsonValidationErrors('title');
    }

    /**
     *@test
     */
    public function the_client_is_optional()
    {
        $this->assertFieldIsValid(['client' => '']);
    }

    /**
     *@test
     */
    public function the_time_period_is_optional()
    {
        $this->assertFieldIsValid(['time_period' => '']);
    }

    /**
     *@test
     */
    public function the_project_type_is_optional()
    {
        $this->assertFieldIsValid(['project_type' => '']);
    }

    private function assertFieldIsValid($field)
    {
        $default = [
            'title' => 'test title',
            'client' => 'test client',
            'time_period' => 'test time',
            'project_type' => 'test project'
        ];
        $response = $this->asLoggedInUser()->postJson("/admin/case-studies", array_merge($default, $field));
        $response->assertStatus(201);

    }
}