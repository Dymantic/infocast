<?php


namespace Tests\Feature\CaseStudies;


use App\CaseStudies\CaseStudy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ClearTitleImageTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function an_existing_title_image_can_be_cleared()
    {
        Storage::fake('media');

        $case_study = factory(CaseStudy::class)->create();
        $case_study->setTitleImage(UploadedFile::fake()->image('test.jpg'));

        $this->withoutExceptionHandling();

        $response = $this->asLoggedInUser()->deleteJson("/admin/case-studies/{$case_study->id}/title-image");
        $response->assertStatus(200);

        $this->assertCount(0, $case_study->fresh()->getMedia(CaseStudy::TITLE_IMAGES));
    }
}