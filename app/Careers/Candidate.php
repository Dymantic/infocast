<?php

namespace App\Careers;

use App\Hiring\Screening;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Candidate extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'cover_letter_id',
        'resume_id',
    ];

    public function screening()
    {
        return $this->hasOne(Screening::class);
    }

    public function markAsScreened($date, $user)
    {
        return $this->screening()->create([
            'screened_on' => Carbon::parse($date),
            'marked_by' => $user->id
        ]);
    }

    public function skipScreening($user)
    {
        return $this->screening()->create([
            'screened_on' => Carbon::today(),
            'marked_by' => $user->id,
            'skipped' => true,
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
            'marked_by' => $user->id,
        ]);
    }

    public function skipRecruiterPhoneInterview($user)
    {
        return $this->recruiterPhoneInterview()->create([
            'interviewed_on' => Carbon::today(),
            'marked_by' => $user->id,
            'skipped' => true,
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
            'marked_by' => $user->id,
        ]);
    }

    public function skipSupervisorPhoneInterview($user)
    {
        return $this->supervisorPhoneInterview()->create([
            'interviewed_on' => Carbon::today(),
            'marked_by' => $user->id,
            'skipped' => true,
        ]);
    }

    public function inPersonMeeting()
    {
        return $this->hasOne(\App\Hiring\InPersonMeeting::class);
    }

    public function inPersonMeetingDone($date, $user)
    {
        return $this->inPersonMeeting()->create([
            'met_on' => Carbon::parse($date),
            'marked_by' => $user->id
        ]);
    }

    public function skipInPersonMeeting($user)
    {
        return $this->inPersonMeeting()->create([
            'met_on' => Carbon::today(),
            'marked_by' => $user->id,
            'skipped' => true
        ]);
    }
}
