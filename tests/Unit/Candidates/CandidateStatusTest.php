<?php


namespace Tests\Unit\Candidates;


use App\Careers\Candidate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class CandidateStatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function a_fresh_candidate()
    {
        $candidate = factory(Candidate::class)->create();

        $this->assertNull($candidate->terminated_on);

        $expected = [
            'status' => 'ongoing',
            'finalised' => false,
            'accepted' => false,
            'ongoing' => true,
            'job_offered' => false,
            'terminated' => false,
            'terminated_on' => null,
            'terminated_by' => null,
            'terminated_reason' => null,
            'deadline' => null,
            'next_milestone' => [
                'name' => 'Initial Screening',
                'url' => '/admin/candidates/' . $candidate->id . '/screened',
                'date_field_name' => 'screened_on',
            ],
            'completed_milestones' => []
        ];

        $this->assertEquals($expected, $candidate->status());
    }

    /**
     *@test
     */
    public function with_deadline()
    {
        $candidate = factory(Candidate::class)->create();
        $deadline = Carbon::today()->addDays(5);
        $candidate->setDeadline($deadline);
        $this->assertNull($candidate->terminated_on);

        $expected = [
            'status' => 'ongoing',
            'finalised' => false,
            'accepted' => false,
            'ongoing' => true,
            'job_offered' => false,
            'terminated' => false,
            'terminated_on' => null,
            'terminated_by' => null,
            'terminated_reason' => null,
            'deadline' => $deadline->format('M j, Y'),
            'next_milestone' => [
                'name' => 'Initial Screening',
                'url' => '/admin/candidates/' . $candidate->id . '/screened',
                'date_field_name' => 'screened_on',
            ],
            'completed_milestones' => []
        ];

        $this->assertEquals($expected, $candidate->status());
    }

    /**
     *@test
     */
    public function been_screened()
    {
        $hr = factory(User::class)->create();
        $candidate = factory(Candidate::class)->create();

        $this->assertNull($candidate->terminated_on);

        $candidate->markAsScreened(Carbon::today(), $hr);

        $expected = [
            'status' => 'ongoing',
            'finalised' => false,
            'accepted' => false,
            'ongoing' => true,
            'job_offered' => false,
            'terminated' => false,
            'terminated_on' => null,
            'terminated_by' => null,
            'terminated_reason' => null,
            'deadline' => null,
            'next_milestone' => [
                'name' => 'Phone Interview (Recruiter)',
                'url' => '/admin/candidates/' . $candidate->id . '/recruiter-phone-interview',
                'date_field_name' => 'interviewed_on',
            ],
            'completed_milestones' => [
                [
                    'name' => 'Initial Screening',
                    'date' => Carbon::today()->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false,
                ]
            ]
        ];

        $this->assertEquals($expected, $candidate->status());
    }

    /**
     *@test
     */
    public function done_recruiter_interview()
    {
        $hr = factory(User::class)->create();
        $candidate = factory(Candidate::class)->create();

        $this->assertNull($candidate->terminated_on);

        $candidate->markAsScreened(Carbon::yesterday(), $hr);
        $candidate->recruiterPhoneInterviewDone(Carbon::today(), $hr);

        $expected = [
            'status' => 'ongoing',
            'finalised' => false,
            'accepted' => false,
            'ongoing' => true,
            'job_offered' => false,
            'terminated' => false,
            'terminated_on' => null,
            'terminated_by' => null,
            'terminated_reason' => null,
            'deadline' => null,
            'next_milestone' => [
                'name' => 'Phone Interview (Supervisor)',
                'url' => '/admin/candidates/' . $candidate->id . '/supervisor-phone-interview',
                'date_field_name' => 'interviewed_on',
            ],
            'completed_milestones' => [
                [
                    'name' => 'Initial Screening',
                    'date' => Carbon::yesterday()->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false,
                ],
                [
                    'name' => 'Phone Interview (Recruiter)',
                    'date' => Carbon::today()->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
            ]
        ];

        $this->assertEquals($expected, $candidate->status());
    }

    /**
     *@test
     */
    public function terminated()
    {
        $hr = factory(User::class)->create();
        $candidate = factory(Candidate::class)->create();

        $this->assertNull($candidate->terminated_on);

        $candidate->markAsScreened(Carbon::yesterday(), $hr);
        $candidate->recruiterPhoneInterviewDone(Carbon::today(), $hr);
        $candidate->terminate('self', 'test reason');

        $expected = [
            'status' => 'terminated',
            'finalised' => false,
            'accepted' => false,
            'ongoing' => false,
            'job_offered' => false,
            'terminated' => true,
            'terminated_on' => Carbon::today(),
            'terminated_by' => 'self',
            'terminated_reason' => 'test reason',
            'deadline' => null,
            'next_milestone' => [
                'name' => 'Phone Interview (Supervisor)',
                'url' => '/admin/candidates/' . $candidate->id . '/supervisor-phone-interview',
                'date_field_name' => 'interviewed_on',
            ],
            'completed_milestones' => [
                [
                    'name' => 'Initial Screening',
                    'date' => Carbon::yesterday()->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false,
                ],
                [
                    'name' => 'Phone Interview (Recruiter)',
                    'date' => Carbon::today()->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
            ]
        ];

        $this->assertEquals($expected, $candidate->status());
    }

    /**
     *@test
     */
    public function done_supervisor_interview()
    {
        $hr = factory(User::class)->create();
        $candidate = factory(Candidate::class)->create();

        $this->assertNull($candidate->terminated_on);

        $candidate->markAsScreened(Carbon::today()->subDays(2), $hr);
        $candidate->recruiterPhoneInterviewDone(Carbon::today()->subDays(1), $hr);
        $candidate->supervisorPhoneInterviewDone(Carbon::today(), $hr);

        $expected = [
            'status' => 'ongoing',
            'finalised' => false,
            'accepted' => false,
            'ongoing' => true,
            'job_offered' => false,
            'terminated' => false,
            'terminated_on' => null,
            'terminated_by' => null,
            'terminated_reason' => null,
            'deadline' => null,
            'next_milestone' => [
                'name' => 'In-person Meeting',
                'url' => '/admin/candidates/' . $candidate->id . '/in-person-meeting',
                'date_field_name' => 'met_on',
            ],
            'completed_milestones' => [
                [
                    'name' => 'Initial Screening',
                    'date' => Carbon::today()->subDays(2)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false,
                ],
                [
                    'name' => 'Phone Interview (Recruiter)',
                    'date' => Carbon::today()->subDays(1)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
                [
                    'name' => 'Phone Interview (Supervisor)',
                    'date' => Carbon::today()->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
            ]
        ];

        $this->assertEquals($expected, $candidate->status());
    }

    /**
     *@test
     */
    public function in_person_meeting_done()
    {
        $hr = factory(User::class)->create();
        $candidate = factory(Candidate::class)->create();

        $this->assertNull($candidate->terminated_on);

        $candidate->markAsScreened(Carbon::today()->subDays(3), $hr);
        $candidate->recruiterPhoneInterviewDone(Carbon::today()->subDays(2), $hr);
        $candidate->supervisorPhoneInterviewDone(Carbon::today()->subDays(1), $hr);
        $candidate->inPersonMeetingDone(Carbon::today(), $hr);

        $expected = [
            'status' => 'under consideration',
            'finalised' => false,
            'accepted' => false,
            'ongoing' => true,
            'job_offered' => false,
            'terminated' => false,
            'terminated_on' => null,
            'terminated_by' => null,
            'terminated_reason' => null,
            'deadline' => null,
            'next_milestone' => [
                'name' => 'Job Offer',
                'url' => '/admin/candidates/' . $candidate->id . '/job-offered',
                'date_field_name' => 'offered_on',
            ],
            'completed_milestones' => [
                [
                    'name' => 'Initial Screening',
                    'date' => Carbon::today()->subDays(3)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false,
                ],
                [
                    'name' => 'Phone Interview (Recruiter)',
                    'date' => Carbon::today()->subDays(2)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
                [
                    'name' => 'Phone Interview (Supervisor)',
                    'date' => Carbon::today()->subDays(1)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
                [
                    'name' => 'In-person Meeting',
                    'date' => Carbon::today()->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
            ]
        ];

        $this->assertEquals($expected, $candidate->status());
    }

    /**
     *@test
     */
    public function job_offered()
    {
        $hr = factory(User::class)->create();
        $candidate = factory(Candidate::class)->create();

        $this->assertNull($candidate->terminated_on);

        $candidate->markAsScreened(Carbon::today()->subDays(4), $hr);
        $candidate->recruiterPhoneInterviewDone(Carbon::today()->subDays(3), $hr);
        $candidate->supervisorPhoneInterviewDone(Carbon::today()->subDays(2), $hr);
        $candidate->inPersonMeetingDone(Carbon::today()->subDays(1), $hr);
        $candidate->offerJob(Carbon::today(), $hr);

        $expected = [
            'status' => 'job offered',
            'finalised' => false,
            'accepted' => false,
            'ongoing' => false,
            'job_offered' => true,
            'terminated' => false,
            'terminated_on' => null,
            'terminated_by' => null,
            'terminated_reason' => null,
            'deadline' => null,
            'next_milestone' => null,
            'completed_milestones' => [
                [
                    'name' => 'Initial Screening',
                    'date' => Carbon::today()->subDays(4)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false,
                ],
                [
                    'name' => 'Phone Interview (Recruiter)',
                    'date' => Carbon::today()->subDays(3)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
                [
                    'name' => 'Phone Interview (Supervisor)',
                    'date' => Carbon::today()->subDays(2)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
                [
                    'name' => 'In-person Meeting',
                    'date' => Carbon::today()->subDays(1)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
                [
                    'name' => 'Job Offered',
                    'date' => Carbon::today()->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
            ]
        ];

        $this->assertEquals($expected, $candidate->status());
    }

    /**
     *@test
     */
    public function job_accepted()
    {
        $hr = factory(User::class)->create();
        $candidate = factory(Candidate::class)->create();

        $this->assertNull($candidate->terminated_on);

        $candidate->markAsScreened(Carbon::today()->subDays(4), $hr);
        $candidate->recruiterPhoneInterviewDone(Carbon::today()->subDays(3), $hr);
        $candidate->supervisorPhoneInterviewDone(Carbon::today()->subDays(2), $hr);
        $candidate->inPersonMeetingDone(Carbon::today()->subDays(1), $hr);
        $candidate->offerJob(Carbon::today(), $hr);
        $candidate->finalise(true);

        $expected = [
            'status' => 'job accepted',
            'finalised' => true,
            'accepted' => true,
            'ongoing' => false,
            'job_offered' => true,
            'terminated' => false,
            'terminated_on' => null,
            'terminated_by' => null,
            'terminated_reason' => null,
            'deadline' => null,
            'next_milestone' => null,
            'completed_milestones' => [
                [
                    'name' => 'Initial Screening',
                    'date' => Carbon::today()->subDays(4)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false,
                ],
                [
                    'name' => 'Phone Interview (Recruiter)',
                    'date' => Carbon::today()->subDays(3)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
                [
                    'name' => 'Phone Interview (Supervisor)',
                    'date' => Carbon::today()->subDays(2)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
                [
                    'name' => 'In-person Meeting',
                    'date' => Carbon::today()->subDays(1)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
                [
                    'name' => 'Job Offered',
                    'date' => Carbon::today()->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
            ]
        ];

        $this->assertEquals($expected, $candidate->status());
    }

    /**
     *@test
     */
    public function job_rejected()
    {
        $hr = factory(User::class)->create();
        $candidate = factory(Candidate::class)->create();

        $this->assertNull($candidate->terminated_on);

        $candidate->markAsScreened(Carbon::today()->subDays(4), $hr);
        $candidate->recruiterPhoneInterviewDone(Carbon::today()->subDays(3), $hr);
        $candidate->supervisorPhoneInterviewDone(Carbon::today()->subDays(2), $hr);
        $candidate->inPersonMeetingDone(Carbon::today()->subDays(1), $hr);
        $candidate->offerJob(Carbon::today(), $hr);
        $candidate->finalise(false);

        $expected = [
            'status' => 'job rejected',
            'finalised' => true,
            'accepted' => false,
            'ongoing' => false,
            'job_offered' => true,
            'terminated' => false,
            'terminated_on' => null,
            'terminated_by' => null,
            'terminated_reason' => null,
            'deadline' => null,
            'next_milestone' => null,
            'completed_milestones' => [
                [
                    'name' => 'Initial Screening',
                    'date' => Carbon::today()->subDays(4)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false,
                ],
                [
                    'name' => 'Phone Interview (Recruiter)',
                    'date' => Carbon::today()->subDays(3)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
                [
                    'name' => 'Phone Interview (Supervisor)',
                    'date' => Carbon::today()->subDays(2)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
                [
                    'name' => 'In-person Meeting',
                    'date' => Carbon::today()->subDays(1)->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
                [
                    'name' => 'Job Offered',
                    'date' => Carbon::today()->format('Y-m-d'),
                    'by' => $hr->name,
                    'skipped' => false
                ],
            ]
        ];

        $this->assertEquals($expected, $candidate->status());
    }
}