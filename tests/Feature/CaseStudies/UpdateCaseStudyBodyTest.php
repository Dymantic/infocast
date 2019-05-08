<?php


namespace Tests\Feature\CaseStudies;


use App\CaseStudies\CaseStudy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateCaseStudyBodyTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function set_the_body_of_a_case_study()
    {
        $this->withoutExceptionHandling();

        $case_study = factory(CaseStudy::class)->create(['body' => '']);

        $response = $this->asLoggedInUser()->postJson("/admin/case-studies/{$case_study->id}/body", [
            'body' => 'test body content'
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('case_studies', [
            'id' => $case_study->id,
            'body' => 'test body content'
        ]);
    }

    /**
     *@test
     */
    public function the_body_can_be_empty()
    {
        $this->withoutExceptionHandling();

        $case_study = factory(CaseStudy::class)->create(['body' => 'will be removed']);

        $response = $this->asLoggedInUser()->postJson("/admin/case-studies/{$case_study->id}/body", [
            'body' => ''
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('case_studies', [
            'id' => $case_study->id,
            'body' => null
        ]);
    }
}