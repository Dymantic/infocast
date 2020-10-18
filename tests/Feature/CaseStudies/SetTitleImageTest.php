<?php


namespace Tests\Feature\CaseStudies;


use App\CaseStudies\CaseStudy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SetTitleImageTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function a_title_image_may_be_uploaded()
    {
        Storage::fake('media', config('filesystems.disks.media'));
        $this->withoutExceptionHandling();

        $case_study = factory(CaseStudy::class)->create();

        $response = $this->asLoggedInUser()->postJson("/admin/case-studies/{$case_study->id}/title-image", [
            'image' => UploadedFile::fake()->image('testpic.jpg')
        ]);
        $response->assertStatus(200);

        $this->assertCount(1, $case_study->fresh()->getMedia(CaseStudy::TITLE_IMAGES));
    }

    /**
     *@test
     */
    public function the_image_is_required()
    {
        Storage::fake('media', config('filesystems.disks.media'));

        $case_study = factory(CaseStudy::class)->create();

        $response = $this->asLoggedInUser()->postJson("/admin/case-studies/{$case_study->id}/title-image", [
            'image' => null
        ]);
        $response->assertStatus(422);

        $this->assertCount(0, $case_study->fresh()->getMedia(CaseStudy::TITLE_IMAGES));
    }

    /**
     *@test
     */
    public function the_image_must_be_a_valid_image_file()
    {
        Storage::fake('media', config('filesystems.disks.media'));

        $case_study = factory(CaseStudy::class)->create();

        $response = $this->asLoggedInUser()->postJson("/admin/case-studies/{$case_study->id}/title-image", [
            'image' => UploadedFile::fake()->create('text_doc.docx')
        ]);
        $response->assertStatus(422);

        $this->assertCount(0, $case_study->fresh()->getMedia(CaseStudy::TITLE_IMAGES));
    }

    /**
     *@test
     */
    public function the_image_must_be_a_file()
    {
        Storage::fake('media', config('filesystems.disks.media'));

        $case_study = factory(CaseStudy::class)->create();

        $response = $this->asLoggedInUser()->postJson("/admin/case-studies/{$case_study->id}/title-image", [
            'image' => 'just text'
        ]);
        $response->assertStatus(422);

        $this->assertCount(0, $case_study->fresh()->getMedia(CaseStudy::TITLE_IMAGES));
    }
}