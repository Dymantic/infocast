<?php

namespace App\Careers;

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

    protected $dates = ['terminated_on'];

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

    public function terminate($terminated_by, $reason)
    {
        $this->terminated_on = Carbon::today();
        $this->terminated_by = $terminated_by;
        $this->terminated_reason = $reason;
        $this->save();
    }

    public function isTerminated()
    {
        return !! $this->terminated_on;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'application_id' => $this->application_id,
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'full_name' => $this->last_name . ', ' . $this->first_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'position' => $this->position,
            'cover_letter_link' => $this->coverLetterUrl(),
            'cover_letter_name' => $this->coverLetterName(),
            'cv_name' => $this->resumeName(),
            'cv_link' => $this->resumeUrl(),
        ];
    }
}
