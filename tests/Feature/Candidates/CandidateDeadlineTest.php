<?php


namespace Tests\Feature\Candidates;


use App\Careers\Candidate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class CandidateDeadlineTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function set_a_deadline_for_the_candidate()
    {
        $this->withoutExceptionHandling();

        $candidate = factory(Candidate::class)->create();

        $response = $this->asLoggedInUser()->postJson("/admin/candidates/{$candidate->id}/deadline", [
            'deadline' => Carbon::today()->addDays(5)->format('Y-m-d'),
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('candidates', [
            'id' => $candidate->id,
            'deadline' => Carbon::today()->addDays(5)->endOfDay(),
        ]);
    }

    /**
     *@test
     */
    public function the_deadline_must_be_a_valid_date()
    {
        $candidate = factory(Candidate::class)->create();

        $response = $this->asLoggedInUser()->postJson("/admin/candidates/{$candidate->id}/deadline", [
            'deadline' => 'not-a-date',
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('deadline');
    }

    /**
     *@test
     */
    public function the_deadline_must_be_in_the_future()
    {
        $candidate = factory(Candidate::class)->create();

        $response = $this->asLoggedInUser()->postJson("/admin/candidates/{$candidate->id}/deadline", [
            'deadline' => Carbon::yesterday()->format('Y-m-d'),
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('deadline');
    }
}