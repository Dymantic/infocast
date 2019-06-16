<?php


namespace Tests\Unit\Candidates;


use App\Careers\Candidate;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CandidatesTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function screen_candidate()
    {
        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => false]);

        $screening = $candidate->markAsScreened(Carbon::today(), $hr)->fresh();

        $this->assertEquals($candidate->id, $screening->candidate_id);
        $this->assertTrue(Carbon::today()->isSameDay($screening->screened_on));
        $this->assertEquals($hr->id, $screening->marked_by);
        $this->assertFalse($screening->skipped);
    }

    /**
     *@test
     */
    public function recruiter_phone_interview_done()
    {
        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => false]);

        $interview = $candidate->recruiterPhoneInterviewDone(Carbon::today(), $hr)->fresh();

        $this->assertEquals($candidate->id, $interview->candidate_id);
        $this->assertTrue(Carbon::today()->isSameDay($interview->interviewed_on));
        $this->assertEquals($hr->id, $interview->marked_by);
        $this->assertFalse($interview->skipped);
    }

    /**
     *@test
     */
    public function recruiter_phone_interview_skipped()
    {
        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => false]);

        $interview = $candidate->skipRecruiterPhoneInterview($hr)->fresh();

        $this->assertEquals($candidate->id, $interview->candidate_id);
        $this->assertTrue(Carbon::today()->isSameDay($interview->interviewed_on));
        $this->assertEquals($hr->id, $interview->marked_by);
        $this->assertTrue($interview->skipped);
    }

    /**
     *@test
     */
    public function supervisor_phone_interview_done()
    {
        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => false]);

        $interview = $candidate->supervisorPhoneInterviewDone(Carbon::today(), $hr)->fresh();

        $this->assertEquals($candidate->id, $interview->candidate_id);
        $this->assertTrue(Carbon::today()->isSameDay($interview->interviewed_on));
        $this->assertEquals($hr->id, $interview->marked_by);
        $this->assertFalse($interview->skipped);
    }

    /**
     *@test
     */
    public function supervisor_phone_interview_skipped()
    {
        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => false]);

        $interview = $candidate->skipSupervisorPhoneInterview($hr)->fresh();

        $this->assertEquals($candidate->id, $interview->candidate_id);
        $this->assertTrue(Carbon::today()->isSameDay($interview->interviewed_on));
        $this->assertEquals($hr->id, $interview->marked_by);
        $this->assertTrue($interview->skipped);
    }

    /**
     *@test
     */
    public function in_person_meeting_done()
    {
        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => false]);

        $meeting = $candidate->inPersonMeetingDone(Carbon::today(), $hr)->fresh();

        $this->assertEquals($candidate->id, $meeting->candidate_id);
        $this->assertTrue(Carbon::today()->isSameDay($meeting->met_on));
        $this->assertEquals($hr->id, $meeting->marked_by);
        $this->assertFalse($meeting->skipped);
    }

    /**
     *@test
     */
    public function in_person_meeting_skipped()
    {
        $candidate = factory(Candidate::class)->create();
        $hr = factory(User::class)->create(['superadmin' => false]);

        $meeting = $candidate->skipInPersonMeeting($hr)->fresh();

        $this->assertEquals($candidate->id, $meeting->candidate_id);
        $this->assertTrue(Carbon::today()->isSameDay($meeting->met_on));
        $this->assertEquals($hr->id, $meeting->marked_by);
        $this->assertTrue($meeting->skipped);
    }
}