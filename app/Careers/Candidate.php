<?php

namespace App\Careers;

use App\Hiring\JobOffer;
use App\Hiring\Screening;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Candidate extends Model
{

    use HasApplicationDocuments;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'cover_letter',
        'cv',
        'position',
    ];

    protected $dates = ['terminated_on', 'deadline', 'accepted_on'];

    protected $casts = ['finalised' => 'boolean'];

    public function screening()
    {
        return $this->hasOne(Screening::class);
    }

    public function markAsScreened($date, $user)
    {
        return $this->screening()->create([
            'screened_on' => Carbon::parse($date),
            'marked_by'   => $user->id
        ]);
    }

    public function skipScreening($user)
    {
        return $this->screening()->create([
            'screened_on' => Carbon::today(),
            'marked_by'   => $user->id,
            'skipped'     => true,
        ]);
    }

    public function recruiterPhoneInterview()
    {
        return $this->hasOne(\App\Hiring\RecruiterPhoneInterview::class);
    }

    public function recruiterPhoneInterviewDone($date, $user)
    {
        return $this->recruiterPhoneInterview()->create([
            'interviewed_on' => Carbon::parse($date),
            'marked_by'      => $user->id,
        ]);
    }

    public function skipRecruiterPhoneInterview($user)
    {
        return $this->recruiterPhoneInterview()->create([
            'interviewed_on' => Carbon::today(),
            'marked_by'      => $user->id,
            'skipped'        => true,
        ]);
    }

    public function supervisorPhoneInterview()
    {
        return $this->hasOne(\App\Hiring\SupervisorPhoneInterview::class);
    }

    public function supervisorPhoneInterviewDone($date, $user)
    {
        return $this->supervisorPhoneInterview()->create([
            'interviewed_on' => Carbon::parse($date),
            'marked_by'      => $user->id,
        ]);
    }

    public function skipSupervisorPhoneInterview($user)
    {
        return $this->supervisorPhoneInterview()->create([
            'interviewed_on' => Carbon::today(),
            'marked_by'      => $user->id,
            'skipped'        => true,
        ]);
    }

    public function inPersonMeeting()
    {
        return $this->hasOne(\App\Hiring\InPersonMeeting::class);
    }

    public function inPersonMeetingDone($date, $user)
    {
        return $this->inPersonMeeting()->create([
            'met_on'    => Carbon::parse($date),
            'marked_by' => $user->id
        ]);
    }

    public function skipInPersonMeeting($user)
    {
        return $this->inPersonMeeting()->create([
            'met_on'    => Carbon::today(),
            'marked_by' => $user->id,
            'skipped'   => true
        ]);
    }

    public function jobOffer()
    {
        return $this->hasOne(JobOffer::class);
    }

    public function offerJob($date, $user)
    {
        return $this->jobOffer()->create([
            'offered_on' => Carbon::parse($date),
            'marked_by'  => $user->id,
        ]);
    }

    public function skipJobOffer($user)
    {
        return $this->jobOffer()->create([
            'offered_on' => Carbon::today(),
            'marked_by'  => $user->id,
            'skipped'    => true,
        ]);
    }

    public function terminate($terminated_by, $reason)
    {
        $this->terminated_on = Carbon::today();
        $this->terminated_by = $terminated_by;
        $this->terminated_reason = $reason;
        $this->save();
    }

    public function isTerminated()
    {
        return !!$this->terminated_on;
    }

    public function setDeadline($date)
    {
        $this->deadline = Carbon::parse($date)->endOfDay();
        $this->save();
    }

    public function finalise($accepted)
    {
        if (!$this->jobOffer) {
            throw new \Exception('cannot finalise without a job offer');
        }
        $this->finalised = true;

        if ($accepted) {
            $this->accepted_on = Carbon::today();
        }

        $this->save();
    }

    public function toArray()
    {
        return [
            'id'                => $this->id,
            'application_id'    => $this->application_id,
            'last_name'         => $this->last_name,
            'first_name'        => $this->first_name,
            'full_name'         => $this->last_name . ', ' . $this->first_name,
            'phone'             => $this->phone,
            'email'             => $this->email,
            'position'          => $this->position,
            'cover_letter_link' => $this->coverLetterUrl(),
            'cover_letter_name' => $this->coverLetterName(),
            'cv_name'           => $this->resumeName(),
            'cv_link'           => $this->resumeUrl(),
        ];
    }

    public function status()
    {
        return [
            'status'               => $this->processStatus(),
            'ongoing'              => $this->isOngoing(),
            'finalised'            => $this->finalised,
            'accepted'             => !!$this->accepted_on,
            'job_offered'          => !!$this->jobOffer,
            'terminated'           => $this->isTerminated(),
            'terminated_on'        => $this->terminated_on,
            'terminated_by'        => $this->terminated_by,
            'terminated_reason'    => $this->terminated_reason,
            'deadline'             => $this->deadline ? $this->deadline->format('M j, Y') : null,
            'next_milestone'       => $this->nextMilestone(),
            'completed_milestones' => $this->completedMilestones(),
        ];
    }

    private function isOngoing()
    {
        return (!$this->finalised) && (!$this->isTerminated()) && (!$this->jobOffer);
    }

    private function processStatus()
    {
        if ($this->finalised && !!$this->accepted_on) {
            return 'job accepted';
        }

        if ($this->finalised && !$this->accepted_on) {
            return 'job rejected';
        }

        if ($this->isTerminated()) {
            return 'terminated';
        }

        if (!!$this->jobOffer) {
            return 'job offered';
        }

        if (!!$this->inPersonMeeting) {
            return 'under consideration';
        }

        return 'ongoing';

    }

    private function nextMilestone()
    {
        if (!$this->screening) {
            return [
                'name'            => 'Initial Screening',
                'url'             => "/admin/candidates/{$this->id}/screened",
                'date_field_name' => 'screened_on',
            ];
        }

        if (!$this->recruiterPhoneInterview) {
            return [
                'name'            => 'Phone Interview (Recruiter)',
                'url'             => "/admin/candidates/{$this->id}/recruiter-phone-interview",
                'date_field_name' => 'interviewed_on',
            ];
        }

        if (!$this->supervisorPhoneInterview) {
            return [
                'name'            => 'Phone Interview (Supervisor)',
                'url'             => "/admin/candidates/{$this->id}/supervisor-phone-interview",
                'date_field_name' => 'interviewed_on',
            ];
        }

        if (!$this->inPersonMeeting) {
            return [
                'name'            => 'In-person Meeting',
                'url'             => "/admin/candidates/{$this->id}/in-person-meeting",
                'date_field_name' => 'met_on',
            ];
        }

        if (!$this->jobOffer) {
            return [
                'name'            => 'Job Offer',
                'url'             => "/admin/candidates/{$this->id}/job-offered",
                'date_field_name' => 'offered_on',
            ];
        }

    }

    private function completedMilestones()
    {
        $completed = collect([]);

        if ($this->screening) {
            $completed->push([
                'name'    => 'Initial Screening',
                'date'    => $this->screening->screened_on->format('Y-m-d'),
                'by'      => $this->screening->userName(),
                'skipped' => $this->screening->skipped,
            ]);
        }

        if ($this->recruiterPhoneInterview) {
            $completed->push([
                'name'    => 'Phone Interview (Recruiter)',
                'date'    => $this->recruiterPhoneInterview->interviewed_on->format('Y-m-d'),
                'by'      => $this->recruiterPhoneInterview->userName(),
                'skipped' => $this->recruiterPhoneInterview->skipped,
            ]);
        }

        if ($this->supervisorPhoneInterview) {
            $completed->push([
                'name'    => 'Phone Interview (Supervisor)',
                'date'    => $this->supervisorPhoneInterview->interviewed_on->format('Y-m-d'),
                'by'      => $this->supervisorPhoneInterview->userName(),
                'skipped' => $this->supervisorPhoneInterview->skipped,
            ]);
        }

        if ($this->inPersonMeeting) {
            $completed->push([
                'name'    => 'In-person Meeting',
                'date'    => $this->inPersonMeeting->met_on->format('Y-m-d'),
                'by'      => $this->inPersonMeeting->userName(),
                'skipped' => $this->inPersonMeeting->skipped,
            ]);
        }

        if ($this->jobOffer) {
            $completed->push([
                'name'    => 'Job Offered',
                'date'    => $this->jobOffer->offered_on->format('Y-m-d'),
                'by'      => $this->jobOffer->userName(),
                'skipped' => $this->jobOffer->skipped,
            ]);
        }

        return $completed->all();
    }
}
