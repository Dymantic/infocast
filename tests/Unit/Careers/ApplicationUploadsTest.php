<?php


namespace Tests\Unit\Careers;


use App\Careers\ApplicationUpload;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ApplicationUploadsTest extends TestCase
{
    use RefreshDatabase;

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
}