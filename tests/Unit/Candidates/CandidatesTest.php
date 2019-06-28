<?php


namespace Tests\Unit\Candidates;


use App\Careers\Application;
use App\Careers\ApplicationUpload;
use App\Careers\Candidate;
use App\Careers\Posting;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    /**
     *@test
     */
    public function terminate_a_candidate()
    {
        $candidate = factory(Candidate::class)->create();

        $candidate->terminate('self', 'does not accept offer');

        $this->assertEquals('self', $candidate->terminated_by);
        $this->assertEquals('does not accept offer', $candidate->terminated_reason);
        $this->assertTrue($candidate->terminated_on->isToday());
        $this->assertTrue($candidate->isTerminated());
    }

    /**
     *@test
     */
    public function a_candidate_to_array_has_correct_info()
    {
        Storage::fake('application_uploads_test');

        $posting = factory(Posting::class)->create(['title' => 'Dream job']);
        $cover_letter = ApplicationUpload::coverLetter(UploadedFile::fake()->create('letter.txt'));
        $resume = ApplicationUpload::resume(UploadedFile::fake()->create('resume.txt'));
        $application = factory(Application::class)->create([
            'first_name' => 'Franco',
            'last_name' => 'Creek',
            'posting_id' => $posting->id,
            'cover_letter' => $cover_letter->id,
            'cv' => $resume->id,
        ]);
        $candidate = $application->track();

        $expected = [
            'id' => $candidate->id,
            'application_id' => $candidate->application_id,
            'last_name' => 'Creek',
            'first_name' => 'Franco',
            'full_name' => 'Creek, Franco',
            'phone' => $application->phone,
            'email' => $application->email,
            'position' => 'Dream job',
            'cover_letter_link' => "/application_uploads/" . $cover_letter->file_path,
            'cover_letter_name' => 'franco_creek_cover_letter.txt',
            'cv_link' => "/application_uploads/" . $resume->file_path,
            'cv_name' => 'franco_creek_cv.txt',
        ];

        $this->assertEquals($expected, $candidate->fresh()->toArray());
    }
}