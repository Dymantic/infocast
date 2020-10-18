<?php


namespace Tests\Feature\Careers;


use App\Careers\Posting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublishPostingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_posting_may_be_published()
    {
        $this->disableExceptionHandling();

        $posting = factory(Posting::class)->create(['published' => false]);

        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/published-postings", ['posting_id' => $posting->id]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('postings', [
            'id'        => $posting->id,
            'published' => true
        ]);
    }

    /**
     *@test
     */
    public function a_published_post_can_be_retracted()
    {
        $this->disableExceptionHandling();

        $posting = factory(Posting::class)->create(['published' => true]);

        $response = $this->asLoggedInUser()
                         ->json('DELETE', "/admin/published-postings/{$posting->id}");
        $response->assertStatus(200);

        $this->assertDatabaseHas('postings', [
            'id'        => $posting->id,
            'published' => false
        ]);
    }

    /**
     *@test
     */
    public function the_posting_id_is_required()
    {
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/published-postings", ['posting_id' => '']);
        $response->assertStatus(422);

        $this->assertArrayHasKey('posting_id', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function the_posting_id_must_be_an_integer()
    {
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/published-postings", ['posting_id' => 'NOT-AN-INTEGER']);
        $response->assertStatus(422);

        $this->assertArrayHasKey('posting_id', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function the_posting_id_must_exist_in_the_postings_table()
    {
        $posting_id = 7;
        $this->assertNull(Posting::find($posting_id));

        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/published-postings", ['posting_id' => $posting_id]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('posting_id', $response->json()['errors']);
    }
}