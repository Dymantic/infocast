<?php


namespace Tests\Feature\CaseStudies;


use App\CaseStudies\CaseStudy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadCaseStudyImageTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function upload_image_to_case_study()
    {
        Storage::fake('media');
        $this->withoutExceptionHandling();

        $case_study = factory(CaseStudy::class)->create();

        $response = $this->asLoggedInUser()->postJson("/admin/case-studies/{$case_study->id}/images", [
            'image' => UploadedFile::fake()->image('testpic.png')
        ]);
        $response->assertStatus(200);

        $this->assertCount(1, $case_study->fresh()->getMedia(CaseStudy::BODY_IMAGES));
        $image = $case_study->fresh()->getFirstMedia(CaseStudy::BODY_IMAGES);
        $this->assertEquals($response->decodeResponseJson('location'), $image->getUrl('web'));
    }

    /**
     *@test
     */
    public function the_image_is_required()
    {
        Storage::fake('media');

        $case_study = factory(CaseStudy::class)->create();

        $response = $this->asLoggedInUser()->postJson("/admin/case-studies/{$case_study->id}/images", [

        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('image');
    }

    /**
     *@test
     */
    public function the_image_must_be_a_file()
    {
        Storage::fake('media');

        $case_study = factory(CaseStudy::class)->create();

        $response = $this->asLoggedInUser()->postJson("/admin/case-studies/{$case_study->id}/images", [
            'image' => 'just text'
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('image');
    }

    /**
     *@test
     */
    public function the_image_must_be_an_image()
    {
        Storage::fake('media');

        $case_study = factory(CaseStudy::class)->create();

        $response = $this->asLoggedInUser()->postJson("/admin/case-studies/{$case_study->id}/images", [
            'image' => UploadedFile::fake()->create('test_doc.docx')
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('image');
    }
}