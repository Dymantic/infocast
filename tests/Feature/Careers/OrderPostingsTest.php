<?php


namespace Tests\Feature\Careers;


use App\Careers\Posting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderPostingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function the_order_of_job_postings_can_be_set()
    {
        $this->disableExceptionHandling();

        $postingA = factory(Posting::class)->create();
        $postingB = factory(Posting::class)->create();
        $postingC = factory(Posting::class)->create();
        $postingD = factory(Posting::class)->create();
        $postingE = factory(Posting::class)->create();

        $response = $this->asLoggedInUser()->json('POST', "/admin/postings-order", [
            'posting_order' => [
                $postingB->id,
                $postingE->id,
                $postingD->id,
                $postingA->id,
                $postingC->id
            ]
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('postings', [
            'id' => $postingA->id,
            'position' => 3
        ]);

        $this->assertDatabaseHas('postings', [
            'id' => $postingB->id,
            'position' => 0
        ]);

        $this->assertDatabaseHas('postings', [
            'id' => $postingC->id,
            'position' => 4
        ]);

        $this->assertDatabaseHas('postings', [
            'id' => $postingD->id,
            'position' => 2
        ]);

        $this->assertDatabaseHas('postings', [
            'id' => $postingE->id,
            'position' => 1
        ]);
    }

    /**
     *@test
     */
    public function the_posting_order_is_required()
    {
        $postingA = factory(Posting::class)->create();
        $postingB = factory(Posting::class)->create();
        $postingC = factory(Posting::class)->create();
        $postingD = factory(Posting::class)->create();
        $postingE = factory(Posting::class)->create();

        $response = $this->asLoggedInUser()->json('POST', "/admin/postings-order", [
            'posting_order' => null
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('posting_order', $response->decodeResponseJson()['errors']);
    }

    /**
     *@test
     */
    public function the_posting_order_must_be_an_array()
    {
        $response = $this->asLoggedInUser()->json('POST', "/admin/postings-order", [
            'posting_order' => 2
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('posting_order', $response->decodeResponseJson()['errors']);
    }

    /**
     *@test
     */
    public function the_posting_order_must_only_contain_ids_of_existing_postings()
    {
        $response = $this->asLoggedInUser()->json('POST', "/admin/postings-order", [
            'posting_order' => [999, 888]
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('posting_order.0', $response->decodeResponseJson()['errors']);
        $this->assertArrayHasKey('posting_order.1', $response->decodeResponseJson()['errors']);
    }
}