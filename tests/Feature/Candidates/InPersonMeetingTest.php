<?php


namespace Tests\Feature\Candidates;


use App\Careers\Candidate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class InPersonMeetingTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function mark_in_person_meeting_as_done()
    {
        $this->withoutExceptionHandling();

        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)
                         ->postJson("/admin/candidates/{$candidate->id}/in-person-meeting", [
                             'met_on' => Carbon::today()->format('Y-m-d'),
                         ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('in_person_meetings', [
            'candidate_id' => $candidate->id,
            'met_on'  => Carbon::today(),
            'marked_by'    => $hr->id,
            'skipped'      => false
        ]);
    }

    /**
     *@test
     */
    public function skip_in_person_meeting()
    {
        $this->withoutExceptionHandling();

        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)
                         ->postJson("/admin/candidates/{$candidate->id}/in-person-meeting", [
                             'skipped' => true,
                         ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('in_person_meetings', [
            'candidate_id' => $candidate->id,
            'met_on'  => Carbon::today(),
            'marked_by'    => $hr->id,
            'skipped'      => true
        ]);
    }

    /**
     *@test
     */
    public function the_meeting_date_must_be_a_valid_date()
    {
        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)
                         ->postJson("/admin/candidates/{$candidate->id}/in-person-meeting", [
                             'met_on' => 'not-a-real-date',
                         ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('met_on');
    }
}