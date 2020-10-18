<?php


namespace Tests\Unit\CaseStudies;


use App\CaseStudies\CaseStudy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class TitleImageTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function title_image_can_be_set()
    {
        Storage::fake('media', config('filesystems.disks.media'));

        $case_study = factory(CaseStudy::class)->create();

        $image = $case_study->setTitleImage(UploadedFile::fake()->image('test.png'));

        $this->assertCount(1, $case_study->fresh()->getMedia(CaseStudy::TITLE_IMAGES));
        $this->assertInstanceOf(Media::class, $image);
        $this->assertTrue($image->fresh()->hasGeneratedConversion('banner'));
        $this->assertTrue($image->fresh()->hasGeneratedConversion('web'));
        $this->assertTrue($image->fresh()->hasGeneratedConversion('thumb'));
    }

    /**
     *@test
     */
    public function adding_a_title_image_removes_any_previous_ones()
    {
        Storage::fake('media', config('filesystems.disks.media'));

        $case_study = factory(CaseStudy::class)->create();

        $case_study->setTitleImage(UploadedFile::fake()->image('test.png'));
        $this->assertCount(1, $case_study->fresh()->getMedia(CaseStudy::TITLE_IMAGES));

        $case_study->setTitleImage(UploadedFile::fake()->image('test_2.png'));
        $this->assertCount(1, $case_study->fresh()->getMedia(CaseStudy::TITLE_IMAGES));
    }

    /**
     *@test
     */
    public function the_title_image_can_be_cleared()
    {
        Storage::fake('media', config('filesystems.disks.media'));

        $case_study = factory(CaseStudy::class)->create();

        $case_study->setTitleImage(UploadedFile::fake()->image('test.png'));
        $this->assertCount(1, $case_study->fresh()->getMedia(CaseStudy::TITLE_IMAGES));

        $case_study->clearTitleImage();
        $this->assertCount(0, $case_study->fresh()->getMedia(CaseStudy::TITLE_IMAGES));
    }
}