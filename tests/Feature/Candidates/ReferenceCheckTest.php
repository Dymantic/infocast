<?php


namespace Tests\Feature\Candidates;


use App\Careers\Candidate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ReferenceCheckTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function check_references()
    {
        $this->withoutExceptionHandling();

        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);
        $date = Carbon::today()->format('Y-m-d');

        $response = $this->actingAs($hr)
                         ->postJson("/admin/candidates/{$candidate->id}/reference-check", [
                             'checked_on' => $date,
                         ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('reference_checks', [
            'candidate_id' => $candidate->id,
            'checked_on'  => Carbon::parse($date),
            'marked_by'    => $hr->id,
            'skipped'      => false
        ]);
    }

    /**
     *@test
     */
    public function skip_reference_check()
    {
        $this->withoutExceptionHandling();

        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)
                         ->postJson("/admin/candidates/{$candidate->id}/reference-check", [
                             'skipped' => true,
                         ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('reference_checks', [
            'candidate_id' => $candidate->id,
            'checked_on'  => Carbon::today(),
            'marked_by'    => $hr->id,
            'skipped'      => true
        ]);
    }

    /**
     *@test
     */
    public function checked_on_date_must_be_valid_date()
    {
        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);
        $date = Carbon::today()->format('Y-m-d');

        $response = $this->actingAs($hr)
                         ->postJson("/admin/candidates/{$candidate->id}/reference-check", [
                             'checked_on' => 'not-a-valid-date',
                         ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('checked_on');
    }
}