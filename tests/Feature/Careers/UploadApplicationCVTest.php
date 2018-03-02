<?php


namespace Tests\Feature\Careers;


use App\Careers\ApplicationUpload;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UploadApplicationCVTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function an_application_cv_can_be_uploaded()
    {
        $this->disableExceptionHandling();

        $response = $this->json('POST', "/applications/uploads/cvs", [
            'cv' => UploadedFile::fake()->create('cv.docx')
        ]);
        $response->assertStatus(201);

        $this->assertArrayHasKey('file_id', $response->decodeResponseJson());
        $avatar_id = $response->decodeResponseJson()['file_id'];
        $this->assertDatabaseHas('application_uploads', [
            'file_id' => $avatar_id,
            'file_type' => 'cv'
        ]);

        $file_path = public_path('application_uploads_test/') . ApplicationUpload::where('file_id',
                $avatar_id)->first()->file_path;

        $this->assertTrue(file_exists($file_path));
    }

    /**
     *@test
     */
    public function the_cv_is_required()
    {
        $response = $this->json('POST', "/applications/uploads/cvs", [
            'cv' => ''
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('cv', $response->decodeResponseJson()['errors']);
    }

    /**
     *@test
     */
    public function the_cover_letter_must_be_a_valid_document_file_type()
    {
        $response = $this->json('POST', "/applications/uploads/cvs", [
            'cv' => UploadedFile::fake()->create('not_a_doc.ai')
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('cv', $response->decodeResponseJson()['errors']);
    }

    /**
     *@test
     */
    public function the_cover_letter_must_be_under_2mb()
    {
        $response = $this->json('POST', "/applications/uploads/cvs", [
            'cv' => UploadedFile::fake()->create('letter.docx', 3000)
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('cv', $response->decodeResponseJson()['errors']);
    }
}