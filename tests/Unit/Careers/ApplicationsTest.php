<?php


namespace Tests\Unit\Careers;


use App\Careers\Application;
use App\Careers\Posting;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}