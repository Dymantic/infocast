<?php


namespace Tests\Feature\Careers;


use App\Careers\Posting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManagePostingApplicationFieldsTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function an_application_field_setting_can_be_updated()
    {
        $this->disableExceptionHandling();
        $posting = factory(Posting::class)->create();

        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}/application-fields", [
                             'first_name' => 'hidden'
                         ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('postings', [
            'application_fields' => json_encode(['first_name' => 'hidden'])
        ]);
    }

    /**
     *@test
     */
    public function another_application_field_can_be_updated()
    {
        $this->disableExceptionHandling();
        $posting = factory(Posting::class)->create(['application_fields' => ['first_name' => 'required']]);

        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}/application-fields", [
                             'last_name' => 'optional'
                         ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('postings', [
            'application_fields' => json_encode(['first_name' => 'required', 'last_name' => 'optional'])
        ]);
    }

    /**
     *@test
     */
    public function updating_a_posting_application_fields_successfully_responds_with_the_updated_fields()
    {
        $this->disableExceptionHandling();
        $posting = factory(Posting::class)->create(['application_fields' => ['first_name' => 'required']]);

        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}/application-fields", [
                             'last_name' => 'optional'
                         ]);
        $response->assertStatus(200);

        $expected = [
            'first_name'       => Posting::FIELD_REQUIRED,
            'last_name'        => Posting::FIELD_OPTIONAL,
            'email'            => Posting::FIELD_REQUIRED,
            'phone'            => Posting::FIELD_REQUIRED,
            'contact_method'   => Posting::FIELD_REQUIRED,
            'gender'           => Posting::FIELD_REQUIRED,
            'date_of_birth'    => Posting::FIELD_REQUIRED,
            'prev_company'     => Posting::FIELD_REQUIRED,
            'prev_position'    => Posting::FIELD_REQUIRED,
            'university'       => Posting::FIELD_REQUIRED,
            'qualifications'   => Posting::FIELD_REQUIRED,
            'skills'           => Posting::FIELD_REQUIRED,
            'english_ability'  => Posting::FIELD_REQUIRED,
            'mandarin_ability' => Posting::FIELD_REQUIRED,
            'notes'            => Posting::FIELD_REQUIRED,
            'avatar'           => Posting::FIELD_REQUIRED,
            'cover_letter'     => Posting::FIELD_REQUIRED,
            'cv'               => Posting::FIELD_REQUIRED,
        ];

        $this->assertEquals($expected, $response->json());
    }

    /**
     *@test
     */
    public function multiple_application_fields_can_be_set_at_once()
    {
        $this->disableExceptionHandling();
        $posting = factory(Posting::class)->create(['application_fields' => ['first_name' => 'required']]);

        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}/application-fields", [
                             'last_name' => 'optional',
                             'prev_company' => 'hidden'
                         ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('postings', [
            'application_fields' => json_encode([
                'first_name' => 'required',
                'last_name' => 'optional',
                'prev_company' => 'hidden'
            ])
        ]);
    }

    /**
     *@test
     */
    public function non_existent_application_fields_will_be_ignored()
    {
        $this->disableExceptionHandling();
        $posting = factory(Posting::class)->create(['application_fields' => ['first_name' => 'required']]);

        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}/application-fields", [
                             'last_name' => 'optional',
                             'prev_company' => 'hidden',
                             'DOES-NOT-EXIST' => 'required'
                         ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('postings', [
            'application_fields' => json_encode([
                'first_name' => 'required',
                'last_name' => 'optional',
                'prev_company' => 'hidden'
            ])
        ]);
    }

    /**
     *@test
     */
    public function the_application_fields_value_must_be_either_required_hidden_or_optional()
    {
        $posting = factory(Posting::class)->create(['application_fields' => ['first_name' => 'required']]);

        $response = $this->asLoggedInUser()
                         ->json('POST', "/admin/postings/{$posting->id}/application-fields", [
                             'last_name' => 'NOT-A-VALID-OPTION'
                         ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('last_name', $response->json()['errors']);

        $this->assertDatabaseHas('postings', [
            'application_fields' => json_encode(['first_name' => 'required'])
        ]);
    }
}