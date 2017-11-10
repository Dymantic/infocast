<?php


namespace Tests\Feature\Careers;


use App\Careers\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteApplicationTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function an_application_may_be_deleted()
    {
        $this->disableExceptionHandling();

        $application = factory(Application::class)->create();

        $response = $this->asLoggedInUser()->delete("/admin/applications/{$application->id}");
        $response->assertStatus(302);
        $response->assertRedirect('/admin/applications');

        $this->assertDatabaseMissing('applications', ['id' => $application->id]);
    }
}