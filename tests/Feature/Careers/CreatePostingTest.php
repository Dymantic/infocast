<?php


namespace Tests\Feature\Careers;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class CreatePostingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_posting_can_be_created()
    {
        $this->disableExceptionHandling();

        $response = $this->asLoggedInUser()->json('POST', "/admin/postings", $this->defaultPostingData());

        $response->assertStatus(200);

        $this->assertDatabaseHas('postings', $this->defaultPostingData(['posted' => Carbon::today()->format('Y-m-d H:i:s')]));
    }

    /**
     * @test
     */
    public function the_title_is_required()
    {
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings", $this->defaultPostingData([
                             'title' => ''
                         ]));

        $response->assertStatus(422);

        $this->assertArrayHasKey('title', $response->decodeResponseJson()['errors']);
    }

    /**
     * @test
     */
    public function the_title_should_be_under_255_characters()
    {
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings", $this->defaultPostingData([
                             'title' => str_repeat('X', 260)
                         ]));

        $response->assertStatus(422);

        $this->assertArrayHasKey('title', $response->decodeResponseJson()['errors']);
    }

    /**
     * @test
     */
    public function the_type_should_be_under_255_characters()
    {
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings", $this->defaultPostingData([
                             'type' => str_repeat('X', 260)
                         ]));

        $response->assertStatus(422);

        $this->assertArrayHasKey('type', $response->decodeResponseJson()['errors']);
    }

    /**
     * @test
     */
    public function the_category_should_be_under_255_characters()
    {
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings", $this->defaultPostingData([
                             'category' => str_repeat('X', 260)
                         ]));

        $response->assertStatus(422);

        $this->assertArrayHasKey('category', $response->decodeResponseJson()['errors']);
    }

    /**
     * @test
     */
    public function the_locatoion_should_be_under_255_characters()
    {
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings", $this->defaultPostingData([
                             'location' => str_repeat('X', 260)
                         ]));

        $response->assertStatus(422);

        $this->assertArrayHasKey('location', $response->decodeResponseJson()['errors']);
    }

    /**
     * @test
     */
    public function the_compensation_should_be_under_255_characters()
    {
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings", $this->defaultPostingData([
                             'compensation' => str_repeat('X', 260)
                         ]));

        $response->assertStatus(422);

        $this->assertArrayHasKey('compensation', $response->decodeResponseJson()['errors']);
    }

    /**
     * @test
     */
    public function the_start_date_should_be_under_255_characters()
    {
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings", $this->defaultPostingData([
                             'start_date' => str_repeat('X', 260)
                         ]));

        $response->assertStatus(422);

        $this->assertArrayHasKey('start_date', $response->decodeResponseJson()['errors']);
    }

    /**
     * @test
     */
    public function the_posted_field_must_be_a_valid_date()
    {
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings", $this->defaultPostingData([
                             'posted' => 'NOT-A-VALID-DATE'
                         ]));

        $response->assertStatus(422);

        $this->assertArrayHasKey('posted', $response->decodeResponseJson()['errors']);
    }

    /**
     * @test
     */
    public function the_posted_field_is_not_required()
    {
        $this->disableExceptionHandling();
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings", $this->defaultPostingData([
                             'posted' => ''
                         ]));

        $response->assertStatus(200);

    }

    /**
     * @test
     */
    public function the_posted_field_can_be_an_iso_date_format()
    {

        $this->disableExceptionHandling();
        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings", $this->defaultPostingData([
                             'posted' => Carbon::today()->format('Y-m-d') . 'T02:41:00.000Z'
                         ]));

        $response->assertStatus(200);



    }

    private function defaultPostingData($attributes = [])
    {
        $default = [
            'title'            => 'TEST TITLE',
            'type'             => 'TEST TYPE',
            'category'         => 'TEST CATEGORY',
            'location'         => 'TEST LOCATION',
            'compensation'     => 'TEST COMPENSATION',
            'posted'           => Carbon::today()->format('Y-m-d'),
            'start_date'       => 'TEST START DATE',
            'introduction'     => 'TEST INTRODUCTION',
            'job_description'  => 'TEST JOB DESCRIPTION',
            'responsibilities' => 'TEST RESPONSIBILITIES',
            'requirements'     => 'TEST REQUIREMENTS'
        ];

        return array_merge($default, $attributes);
    }
}