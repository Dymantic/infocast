<?php


namespace Tests\Feature\Candidates;


use App\Careers\Candidate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class FinaliseCandidateTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function accept_a_job_offer()
    {
        $this->withoutExceptionHandling();

        $hr = factory(User::class)->create();
        $candidate = factory(Candidate::class)->create();
        $candidate->offerJob(Carbon::today(), $hr);

        $response = $this
            ->asLoggedInUser()
            ->postJson("/admin/candidates/{$candidate->id}/finalise-job-offer", [
                'accepted' => true,
            ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('candidates', [
            'id' => $candidate->id,
            'finalised' => true,
            'accepted_on' => Carbon::today()
        ]);
    }

    /**
     *@test
     */
    public function reject_an_offer()
    {
        $this->withoutExceptionHandling();

        $hr = factory(User::class)->create();
        $candidate = factory(Candidate::class)->create();
        $candidate->offerJob(Carbon::today(), $hr);

        $response = $this
            ->asLoggedInUser()
            ->postJson("/admin/candidates/{$candidate->id}/finalise-job-offer", [
                'accepted' => false,
            ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('candidates', [
            'id' => $candidate->id,
            'finalised' => true,
            'accepted_on' => null,
        ]);
    }

    /**
     *@test
     */
    public function the_accepted_field_is_required()
    {
        $hr = factory(User::class)->create();
        $candidate = factory(Candidate::class)->create();
        $candidate->offerJob(Carbon::today(), $hr);

        $response = $this
            ->asLoggedInUser()
            ->postJson("/admin/candidates/{$candidate->id}/finalise-job-offer", [
                'accepted' => null,
            ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('accepted');
    }

    /**
     *@test
     */
    public function accepted_must_be_a_boolean_value()
    {
        $hr = factory(User::class)->create();
        $candidate = factory(Candidate::class)->create();
        $candidate->offerJob(Carbon::today(), $hr);

        $response = $this
            ->asLoggedInUser()
            ->postJson("/admin/candidates/{$candidate->id}/finalise-job-offer", [
                'accepted' => 'this-aint-no-bool',
            ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('accepted');
    }

    /**
     *@test
     */
    public function throws_error_if_job_has_not_already_been_offered()
    {
        $candidate = factory(Candidate::class)->create();
        $this->assertFalse(!! $candidate->jobOffer);

        $response = $this
            ->asLoggedInUser()
            ->postJson("/admin/candidates/{$candidate->id}/finalise-job-offer", [
                'accepted' => true,
            ]);
        $response->assertStatus(500);

        $this->assertDatabaseHas('candidates', [
            'id' => $candidate->id,
            'finalised' => false,
            'accepted_on' => null,
        ]);
    }
}