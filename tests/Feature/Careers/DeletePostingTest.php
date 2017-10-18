<?php


namespace Tests\Feature\Careers;


use App\Careers\Posting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeletePostingTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function a_posting_can_be_deleted()
    {
        $this->disableExceptionHandling();
        $posting = factory(Posting::class)->create();

        $response = $this->asLoggedInUser()->delete("/admin/postings/{$posting->id}");
        $response->assertStatus(302);
        $response->assertRedirect('/admin/postings');

        $this->assertDatabaseMissing('postings', ['id' => $posting->id]);
    }
}