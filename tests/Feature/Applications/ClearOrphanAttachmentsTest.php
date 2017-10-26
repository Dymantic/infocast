<?php

namespace Tests\Feature\Attachments;

use App\Careers\Application;
use App\Careers\ApplicationUpload;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ClearOrphanAttachmentsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        Storage::disk('application_uploads_test')->deleteDirectory('avatars');
        Storage::disk('application_uploads_test')->deleteDirectory('covers_letters');
        Storage::disk('application_uploads_test')->deleteDirectory('cvs');
    }


    /**
     *@test
     */
    public function application_uploads_not_belonging_to_an_existing_application_are_removed()
    {
        $avatar = ApplicationUpload::avatar(UploadedFile::fake()->image('avatar.png'));
        $avatar->created_at = Carbon::parse('-3 hours');
        $avatar->save();
        $letter = ApplicationUpload::coverLetter(UploadedFile::fake()->create('letter.docx'));
        $letter->created_at = Carbon::parse('-3 hours');
        $letter->save();
        $cv = ApplicationUpload::resume(UploadedFile::fake()->create('cv.pdf'));
        $cv->created_at = Carbon::parse('-3 hours');
        $cv->save();

        $this->assertCount(3, Storage::disk('application_uploads_test')->allFiles());

        Artisan::call('application_uploads:clear');

        $this->assertCount(0, Storage::disk('application_uploads_test')->allFiles());
    }

    /**
     *@test
     */
    public function application_uploads_that_belong_to_an_application_are_not_cleared()
    {
        $avatar = ApplicationUpload::avatar(UploadedFile::fake()->image('avatar.png'));
        $avatar->created_at = Carbon::parse('-3 hours');
        $avatar->save();
        $letter = ApplicationUpload::coverLetter(UploadedFile::fake()->create('letter.docx'));
        $letter->created_at = Carbon::parse('-3 hours');
        $letter->save();
        $cv = ApplicationUpload::resume(UploadedFile::fake()->create('cv.pdf'));
        $cv->created_at = Carbon::parse('-3 hours');
        $cv->save();
        $application = factory(Application::class)->create([
            'avatar' => $avatar->id,
            'cv' => $cv->id
        ]);

        $this->assertCount(3, Storage::disk('application_uploads_test')->allFiles());

        Artisan::call('application_uploads:clear');

        $this->assertCount(2, Storage::disk('application_uploads_test')->allFiles());
        $this->assertTrue(Storage::disk(config('application_uploads.disk'))->exists($avatar->file_path));
        $this->assertTrue(Storage::disk(config('application_uploads.disk'))->exists($cv->file_path));
    }

    /**
     *@test
     */
    public function no_files_uploaded_in_the_last_hour_are_cleared()
    {
        $avatar = ApplicationUpload::avatar(UploadedFile::fake()->image('avatar.png'));
        $letter = ApplicationUpload::coverLetter(UploadedFile::fake()->create('letter.docx'));
        $cv = ApplicationUpload::resume(UploadedFile::fake()->create('cv.pdf'));

        $avatar->created_at = Carbon::parse('-3 hours');
        $avatar->save();

        $this->assertCount(3, Storage::disk('application_uploads_test')->allFiles());

        Artisan::call('application_uploads:clear');

        $this->assertCount(2, Storage::disk('application_uploads_test')->allFiles());
        $this->assertTrue(Storage::disk(config('application_uploads.disk'))->exists($letter->file_path));
        $this->assertTrue(Storage::disk(config('application_uploads.disk'))->exists($cv->file_path));
    }
}