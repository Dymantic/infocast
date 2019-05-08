<?php

namespace Tests\Feature\CaseStudies;

use App\CaseStudies\CaseStudy;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublishCaseStudyTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function publish_a_case_study()
    {
        $this->withoutExceptionHandling();

        $case_study = factory(CaseStudy::class)->create(['is_draft' => true]);

        $response = $this->asLoggedInUser()->postJson("/admin/published-case-studies", [
            'case_study_id' => $case_study->id
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('case_studies', [
            'id' => $case_study->id,
            'is_draft' => false
        ]);
    }
}
