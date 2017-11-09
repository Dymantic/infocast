<?php


namespace Tests\Feature\Careers;


use App\Careers\ApplicationUpload;
use App\Careers\Posting;
use App\Notifications\ApplicationReceived;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ApplicationNotificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function a_notification_is_sent_when_an_application_is_successfully_submitted()
    {
        Notification::fake();
        $avatar = ApplicationUpload::avatar(UploadedFile::fake()->image('avatar.png'));
        $letter = ApplicationUpload::coverLetter(UploadedFile::fake()->create('letter.docx'));
        $cv = ApplicationUpload::resume(UploadedFile::fake()->create('cv.png'));

        $this->disableExceptionHandling();

        $posting = factory(Posting::class)->create(['title' => 'TEST POST TITLE']);

        $application_details = $this->defaultApplicationDetails([
            'avatar'       => $avatar->file_id,
            'cover_letter' => $letter->file_id,
            'cv'           => $cv->file_id
        ]);
        $response = $this->json('POST', "/postings/{$posting->id}/applications", $application_details);
        $response->assertStatus(200);

        $secretary = app()->make('secretary');

        Notification::assertSentTo($secretary, ApplicationReceived::class, function($notification, $channels) {
            return $notification->application->first_name === 'TEST FIRST NAME' &&
                $notification->posting === 'TEST POST TITLE' &&
                in_array('slack', $channels) && in_array('mail', $channels);
        });
    }


    private function defaultApplicationDetails($overrides = [])
    {
        $avatar = ApplicationUpload::avatar(UploadedFile::fake()->image('avatar.png'));
        $letter = ApplicationUpload::coverLetter(UploadedFile::fake()->create('letter.docx'));
        $cv = ApplicationUpload::resume(UploadedFile::fake()->create('cv.png'));

        $default = [
            'first_name'       => 'TEST FIRST NAME',
            'last_name'        => 'TEST LAST NAME',
            'email'            => 'TEST@EMAIL.COM',
            'phone'            => 'TEST PHONE',
            'contact_method'   => 'phone',
            'gender'           => 'female',
            'date_of_birth'    => '01/01/1980',
            'prev_company'     => 'TEST COMPANY',
            'prev_position'    => 'TEST POSITION',
            'university'       => 'TEST UNIVERSITY',
            'qualifications'   => 'TEST QUALIFICATIONS',
            'skills'           => 'TEST SKILLS',
            'english_ability'  => 'excellent',
            'mandarin_ability' => 'poor',
            'notes'            => 'TEST NOTES',
            'avatar'           => $avatar->file_id,
            'cover_letter'     => $letter->file_id,
            'cv'               => $cv->file_id
        ];

        return array_merge($default, $overrides);
    }
}