<?php


namespace Tests\Unit\Careers;


use App\Careers\Application;
use App\Careers\ApplicationUpload;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ApplicationUploadsTest extends TestCase
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
    public function an_avatar_upload_can_be_created_from_an_uploaded_file()
    {
        $avatar = UploadedFile::fake()->image('avatar.png');

        $avatar = ApplicationUpload::avatar($avatar);


        $this->assertTrue(file_exists(public_path('application_uploads_test/')  .  $avatar->file_path));
        $this->assertNotNull($avatar->file_id);
    }

    /**
     *@test
     */
    public function a_cover_letter_upload_can_be_created_from_an_uploaded_file()
    {
        $letter = UploadedFile::fake()->create('letter.pdf');

        $cover_letter = ApplicationUpload::coverLetter($letter);

        $this->assertTrue(Storage::disk('application_uploads_test')->exists($cover_letter->file_path));
        $this->assertNotNull($cover_letter->file_id);
        $this->assertEquals('cover_letter', $cover_letter->file_type);
    }

    /**
     *@test
     */
    public function a_resume_can_be_created_from_an_uploaded_cv()
    {
        $cv = UploadedFile::fake()->create('cv.pdf');

        $resume = ApplicationUpload::resume($cv);

        $this->assertTrue(Storage::disk('application_uploads_test')->exists($resume->file_path));
        $this->assertNotNull($resume->file_id);
        $this->assertEquals('cv', $resume->file_type);
    }

    /**
     *@test
     */
    public function an_application_upload_can_be_fetched_by_its_file_id()
    {
        $cv = ApplicationUpload::resume(UploadedFile::fake()->create('cv.pdf'));

        $fetched = ApplicationUpload::byFileId($cv->file_id);

        $this->assertTrue($fetched->is($cv));
    }

    /**
     *@test
     */
    public function an_application_upload_knows_if_it_belongs_to_a_submitted_application()
    {
        $avatar = ApplicationUpload::avatar(UploadedFile::fake()->image('avatar.png'));
        $letter = ApplicationUpload::coverLetter(UploadedFile::fake()->create('letter.docx'));
        $application = factory(Application::class)->create([
            'avatar' => $avatar->id
        ]);

        $this->assertTrue($avatar->fresh()->belongsToSubmittedApplication());
        $this->assertFalse($letter->fresh()->belongsToSubmittedApplication());
    }

    /**
     *@test
     */
    public function deleting_an_application_upload_record_deletes_the_actual_file()
    {
        $avatar = ApplicationUpload::avatar(UploadedFile::fake()->image('avatar.png'));

        $this->assertTrue(Storage::disk('application_uploads_test')->exists($avatar->file_path));

        $avatar->delete();

        $this->assertFalse(Storage::disk('application_uploads_test')->exists($avatar->file_path));
    }
}