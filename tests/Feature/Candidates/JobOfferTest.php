<?php


namespace Tests\Feature\Candidates;


use App\Careers\Candidate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class JobOfferTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function offer_the_job()
    {
        $this->withoutExceptionHandling();

        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)
                         ->postJson("/admin/candidates/{$candidate->id}/job-offered", [
                             'offered_on' => Carbon::today()->format('Y-m-d'),
                         ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('job_offers', [
            'candidate_id' => $candidate->id,
            'offered_on'  => Carbon::today(),
            'marked_by'    => $hr->id,
            'skipped'      => false
        ]);
    }

    /**
     *@test
     */
    public function skip_job_offer()
    {
        $this->withoutExceptionHandling();

        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)
                         ->postJson("/admin/candidates/{$candidate->id}/job-offered", [
                             'skipped' => true,
                         ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('job_offers', [
            'candidate_id' => $candidate->id,
            'offered_on'  => Carbon::today(),
            'marked_by'    => $hr->id,
            'skipped'      => true
        ]);
    }

    /**
     *@test
     */
    public function the_offered_on_date_must_be_valid_date()
    {
        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)
                         ->postJson("/admin/candidates/{$candidate->id}/job-offered", [
                             'offered_on' => 'not-a-valid-date',
                         ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('offered_on');
    }
}