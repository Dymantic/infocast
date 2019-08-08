<?php


namespace Tests\Feature\Candidates;


use App\Careers\Candidate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class TerminateCandidateTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function a_candidate_can_be_terminated()
    {
        $this->withoutExceptionHandling();

        $candidate = factory(Candidate::class)->create();

        $response = $this->asLoggedInUser()->postJson("/admin/candidates/{$candidate->id}/terminate", [
            'terminated_by' => 'self',
            'reason' => 'test reason'
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('candidates', [
            'id' => $candidate->id,
            'terminated_on' => Carbon::today(),
            'terminated_by' => 'self',
            'terminated_reason' => 'test reason'
        ]);


    }
}