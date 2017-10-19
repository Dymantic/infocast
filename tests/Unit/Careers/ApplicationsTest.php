<?php


namespace Tests\Unit\Careers;


use App\Careers\Application;
use App\Careers\ApplicationUpload;
use App\Careers\Posting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ApplicationsTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function an_application_belongs_to_a_posting()
    {
        $posting = factory(Posting::class)->create();

        $application = factory(Application::class)->create(['posting_id' => $posting->id]);

        $this->assertTrue($application->fresh()->posting->is($posting));
    }

    /**
     *@test
     */
    public function an_application_can_get_the_avatar_url_when_it_exists()
    {
        $avatar = ApplicationUpload::avatar(UploadedFile::fake()->image('testpic.jpg'));
        $application = factory(Application::class)->create(['avatar' => $avatar->id]);

        $this->assertEquals('/application_uploads/' . $avatar->file_path, $application->avatarUrl());
    }

    /**
     *@test
     */
    public function an_application_without_an_attached_avatar_has_a_null_avatar_url()
    {
        $application = factory(Application::class)->create(['avatar' => null]);

        $this->assertNull($application->avatarUrl());
    }

    /**
     *@test
     */
    public function an_application_can_get_the_cover_letter_download_link()
    {
        $letter = ApplicationUpload::coverLetter(UploadedFile::fake()->create('testdoc.doc'));
        $application = factory(Application::class)->create(['cover_letter' => $letter->id]);

        $this->assertEquals('/application_uploads/' . $letter->file_path, $application->coverLetterUrl());
    }

    /**
     *@test
     */
    public function the_cover_letter_url_of_an_application_with_no_cover_letter_is_null()
    {
        $application = factory(Application::class)->create(['cover_letter' => null]);

        $this->assertNull($application->coverLetterUrl());
    }

    /**
     *@test
     */
    public function the_url_can_be_fetched_for_the_cv_when_it_exists()
    {
        $cv = ApplicationUpload::resume(UploadedFile::fake()->create('cv.pdf'));
        $application = factory(Application::class)->create(['cv' => $cv->id]);

        $this->assertEquals('/application_uploads/' . $cv->file_path, $application->resumeUrl());
    }

    /**
     *@test
     */
    public function the_resume_url_is_null_if_none_is_attatched()
    {
        $application = factory(Application::class)->create(['cv' => null]);

        $this->assertNull($application->resumeUrl());
    }
}