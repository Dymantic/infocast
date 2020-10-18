<?php


namespace Tests\Unit\CaseStudies;


use App\CaseStudies\CaseStudy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class BodyImagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function add_a_body_image()
    {
        $case_study = factory(CaseStudy::class)->create();

        $image = $case_study->addBodyImage(UploadedFile::fake()->image('test.jpg'));

        $this->assertCount(1, $case_study->getMedia(CaseStudy::BODY_IMAGES));
        $this->assertInstanceOf(Media::class, $image);
        $this->assertTrue($image->fresh()->hasGeneratedConversion('web'));
    }
}