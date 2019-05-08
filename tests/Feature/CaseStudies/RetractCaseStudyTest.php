<?php


namespace Tests\Feature\CaseStudies;


use App\CaseStudies\CaseStudy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RetractCaseStudyTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function retract_a_case_study()
    {
        $this->withoutExceptionHandling();

        $case_study = factory(CaseStudy::class)->create();
        $case_study->publish();

        $response = $this->asLoggedInUser()->deleteJson("/admin/published-case-studies/{$case_study->id}");
        $response->assertStatus(200);

        $this->assertDatabaseHas('case_studies', [
            'id' => $case_study->id,
            'is_draft' => true
        ]);
    }
}