<?php


namespace Tests\Feature\Candidates;


use App\Careers\Candidate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ScreenedCandidateTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function mark_candidate_as_screened()
    {
        $this->withoutExceptionHandling();

        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)->postJson("/admin/candidates/{$candidate->id}/screened", [
            'screened_on' => Carbon::today()->format('Y-m-d'),
        ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('screenings', [
            'candidate_id' => $candidate->id,
            'screened_on' => Carbon::today(),
            'marked_by' => $hr->id,
            'skipped' => false
        ]);
    }

    /**
     *@test
     */
    public function the_screening_date_must_be_a_valid_date()
    {
        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)->postJson("/admin/candidates/{$candidate->id}/screened", [
            'screened_on' => 'not-a-real-date',
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('screened_on');
    }

    /**
     *@test
     */
    public function skipped_screening()
    {
        $this->withoutExceptionHandling();

        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)->postJson("/admin/candidates/{$candidate->id}/screened", [
            'skipped' => true,
        ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('screenings', [
            'candidate_id' => $candidate->id,
            'screened_on' => Carbon::today(),
            'marked_by' => $hr->id,
            'skipped' => true
        ]);
    }
}