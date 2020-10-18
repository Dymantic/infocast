<?php


namespace Tests\Feature\Careers;


use App\Careers\Posting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class UpdatePostingsTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     *@test
     */
    public function a_posting_can_be_updated()
    {
        $this->disableExceptionHandling();
        $posting = factory(Posting::class)->create([
            'title'            => 'OLD TITLE',
            'type'             => 'OLD TYPE',
            'category'         => 'OLD CATEGORY',
            'location'         => 'OLD LOCATION',
            'compensation'     => 'OLD COMPENSATION',
            'posted'           => Carbon::parse('-3 days'),
            'start_date'       => 'OLD START DATE',
            'introduction'     => 'OLD INTRODUCTION',
            'job_description'  => 'OLD JOB DESCRIPTION',
            'responsibilities' => 'OLD RESPONSIBILITIES',
            'requirements'     => 'OLD REQUIREMENTS'
        ]);
        
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}", $this->validNewPostDefaults());

        $response->assertStatus(200);

        $this->assertDatabaseHas('postings', array_merge(
            ['id' => $posting->id],
            $this->validNewPostDefaults(),
            ['posted' => Carbon::today()->format('Y-m-d H:i:s')]
        ));
    }

    /**
     *@test
     */
    public function successfully_updating_a_post_responsds_with_the_fresh_data()
    {
        $this->disableExceptionHandling();
        $posting = factory(Posting::class)->create([
            'title'            => 'OLD TITLE',
            'type'             => 'OLD TYPE',
            'category'         => 'OLD CATEGORY',
            'location'         => 'OLD LOCATION',
            'compensation'     => 'OLD COMPENSATION',
            'posted'           => Carbon::parse('-3 days'),
            'start_date'       => 'OLD START DATE',
            'introduction'     => 'OLD INTRODUCTION',
            'job_description'  => 'OLD JOB DESCRIPTION',
            'responsibilities' => 'OLD RESPONSIBILITIES',
            'requirements'     => 'OLD REQUIREMENTS'
        ]);

        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}", $this->validNewPostDefaults());

        $response->assertStatus(200);

        $this->assertEquals($posting->fresh()->toJsonableArray(), $response->json());
    }

    /**
     *@test
     */
    public function the_title_field_is_required()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}", $this->validNewPostDefaults([
                             'title' => ''
                         ]));
        $response->assertStatus(422);

        $this->assertArrayHasKey('title', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function the_title_field_cannot_be_over_255_characters()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}", $this->validNewPostDefaults([
                             'title' => str_repeat('X', 257)
                         ]));
        $response->assertStatus(422);

        $this->assertArrayHasKey('title', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function the_type_field_cannot_be_over_255_characters()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}", $this->validNewPostDefaults([
                             'type' => str_repeat('X', 257)
                         ]));
        $response->assertStatus(422);

        $this->assertArrayHasKey('type', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function the_category_field_cannot_be_over_255_characters()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}", $this->validNewPostDefaults([
                             'category' => str_repeat('X', 257)
                         ]));
        $response->assertStatus(422);

        $this->assertArrayHasKey('category', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function the_location_field_cannot_be_over_255_characters()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}", $this->validNewPostDefaults([
                             'location' => str_repeat('X', 257)
                         ]));
        $response->assertStatus(422);

        $this->assertArrayHasKey('location', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function the_compensation_field_cannot_be_over_255_characters()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}", $this->validNewPostDefaults([
                             'compensation' => str_repeat('X', 257)
                         ]));
        $response->assertStatus(422);

        $this->assertArrayHasKey('compensation', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function the_start_date_field_cannot_be_over_255_characters()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}", $this->validNewPostDefaults([
                             'start_date' => str_repeat('X', 257)
                         ]));
        $response->assertStatus(422);

        $this->assertArrayHasKey('start_date', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function the_posted_field_must_be_a_valid_date_string()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}", $this->validNewPostDefaults([
                             'posted' => 'NOT-A-VALID-DATE'
                         ]));
        $response->assertStatus(422);

        $this->assertArrayHasKey('posted', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function the_posted_field_is_not_required()
    {
        $this->disableExceptionHandling();
        $posting = factory(Posting::class)->create();
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}", $this->validNewPostDefaults([
                             'posted' => ''
                         ]));
        $response->assertStatus(200);
    }



    private function validNewPostDefaults($overrides = [])
    {
        $defaults = [
            'title'            => 'NEW TITLE',
            'type'             => 'NEW TYPE',
            'category'         => 'NEW CATEGORY',
            'location'         => 'NEW LOCATION',
            'compensation'     => 'NEW COMPENSATION',
            'posted'           => Carbon::today()->format('Y-m-d'),
            'start_date'       => 'NEW START DATE',
            'introduction'     => 'NEW INTRODUCTION',
            'job_description'  => 'NEW JOB DESCRIPTION',
            'responsibilities' => 'NEW RESPONSIBILITIES',
            'requirements'     => 'NEW REQUIREMENTS'
        ];
        return array_merge($defaults, $overrides);
    }
}