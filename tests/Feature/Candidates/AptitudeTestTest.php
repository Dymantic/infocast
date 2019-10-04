<?php


namespace Tests\Feature\Candidates;


use App\Careers\Candidate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AptitudeTestTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function mark_aptitude_test_as_done()
    {
        $this->withoutExceptionHandling();

        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)
                         ->postJson("/admin/candidates/{$candidate->id}/aptitude-test", [
                             'tested_on' => Carbon::today()->format('Y-m-d'),
                         ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('aptitude_tests', [
            'candidate_id' => $candidate->id,
            'tested_on'  => Carbon::today(),
            'marked_by'    => $hr->id,
            'skipped'      => false
        ]);
    }

    /**
     *@test
     */
    public function skip_aptitude_test()
    {
        $this->withoutExceptionHandling();

        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)
                         ->postJson("/admin/candidates/{$candidate->id}/aptitude-test", [
                             'skipped' => true,
                         ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('aptitude_tests', [
            'candidate_id' => $candidate->id,
            'tested_on'  => Carbon::today(),
            'marked_by'    => $hr->id,
            'skipped'      => true
        ]);
    }

    /**
     *@test
     */
    public function tested_on_must_be_a_valid_date()
    {
        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($hr)
                         ->postJson("/admin/candidates/{$candidate->id}/aptitude-test", [
                             'tested_on' => 'not-a-valid-date',
                         ]);
        $response->assertStatus(422);
    }
}