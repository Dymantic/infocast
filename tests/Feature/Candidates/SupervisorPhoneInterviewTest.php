<?php


namespace Tests\Feature\Candidates;


use App\Careers\Candidate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class SupervisorPhoneInterviewTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function mark_supervisor_phone_interview_as_done()
    {
        $this->withoutExceptionHandling();

        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)
                         ->postJson("/admin/candidates/{$candidate->id}/supervisor-phone-interview", [
                             'interviewed_on' => Carbon::today()->format('Y-m-d'),
                         ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('supervisor_phone_interviews', [
            'candidate_id' => $candidate->id,
            'interviewed_on'  => Carbon::today(),
            'marked_by'    => $hr->id,
            'skipped'      => false
        ]);
    }

    /**
     *@test
     */
    public function the_interviewed_on_date_must_be_a_valid_date()
    {
        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)
                         ->postJson("/admin/candidates/{$candidate->id}/supervisor-phone-interview", [
                             'interviewed_on' => 'not-a-date',
                         ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('interviewed_on');
    }

    /**
     *@test
     */
    public function skip_supervisor_phone_interview()
    {
        $this->withoutExceptionHandling();

        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)
                         ->postJson("/admin/candidates/{$candidate->id}/supervisor-phone-interview", [
                             'skipped' => true,
                         ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('supervisor_phone_interviews', [
            'candidate_id' => $candidate->id,
            'interviewed_on'  => Carbon::today(),
            'marked_by'    => $hr->id,
            'skipped'      => true
        ]);
    }
}