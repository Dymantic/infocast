<?php

namespace Tests\Feature\Careers;

use App\Careers\ApplicationUpload;
use App\Careers\Posting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SubmitApplicationsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function an_application_can_be_submitted()
    {
        $avatar = ApplicationUpload::avatar(UploadedFile::fake()->image('avatar.png'));
        $letter = ApplicationUpload::coverLetter(UploadedFile::fake()->create('letter.docx'));
        $cv = ApplicationUpload::resume(UploadedFile::fake()->create('cv.png'));

        $this->disableExceptionHandling();

        $posting = factory(Posting::class)->create();

        $application_details = $this->defaultApplicationDetails([
            'avatar'           => $avatar->file_id,
            'cover_letter'     => $letter->file_id,
            'cv'               => $cv->file_id
        ]);

        $response = $this->json('POST', "/postings/{$posting->id}/applications", $application_details);

        $response->assertStatus(200);

        $this->assertDatabaseHas('applications', array_merge(
            ['posting_id' => $posting->id],
            $application_details,
            ['avatar' => $avatar->id, 'cover_letter' => $letter->id, 'cv' => $cv->id]
        ));
    }

    /**
     * @test
     */
    public function the_applicants_name_is_required()
    {
        $this->assertRequired('first_name');
    }

    /**
     *@test
     */
    public function the_first_name_cannot_be_over_255_characters()
    {
        $this->assertMaxLength('first_name');
    }

    /**
     *@test
     */
    public function the_last_name_is_required()
    {
        $this->assertRequired('last_name');
    }

    /**
     *@test
     */
    public function the_last_name_must_be_under_255_characters()
    {
        $this->assertMaxLength('last_name');
    }

    /**
     *@test
     */
    public function the_email_is_required()
    {
        $this->assertRequired('email');
    }

    /**
     *@test
     */
    public function the_email_must_be_a_valid_email()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->json(
            'POST',
            "/postings/{$posting->id}/applications",
            $this->defaultApplicationDetails(['email' => 'NOT-A-VALID-EMAIL'])
        );

        $response->assertStatus(422);
        $this->assertArrayHasKey('email', $response->decodeResponseJson()['errors']);
    }

    /**
     *@test
     */
    public function the_phone_field_is_required()
    {
        $this->assertRequired('phone');
    }

    /**
     *@test
     */
    public function the_phone_must_be_under_255_characters()
    {
        $this->assertMaxLength('phone');
    }

    /**
     *@test
     */
    public function the_contact_method_is_required()
    {
        $this->assertRequired('contact_method');
    }

    /**
     *@test
     */
    public function the_contact_method_must_be_either_email_or_phone()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->json(
            'POST',
            "/postings/{$posting->id}/applications",
            $this->defaultApplicationDetails(['contact_method' => 'not phone nor email'])
        );

        $response->assertStatus(422);
        $this->assertArrayHasKey('contact_method', $response->decodeResponseJson()['errors']);
    }

    /**
     *@test
     */
    public function the_gender_is_required()
    {
        $this->assertRequired('gender');
    }

    /**
     *@test
     */
    public function the_gender_must_be_either_male_or_female()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->json(
            'POST',
            "/postings/{$posting->id}/applications",
            $this->defaultApplicationDetails(['gender' => 'not male nor female'])
        );

        $response->assertStatus(422);
        $this->assertArrayHasKey('gender', $response->decodeResponseJson()['errors']);
    }

    /**
     *@test
     */
    public function the_date_of_birth_is_required()
    {
        $this->assertRequired('date_of_birth');
    }

    /**
     *@test
     */
    public function the_date_of_birth_must_be_under_255_characters()
    {
        $this->assertMaxLength('date_of_birth');
    }

    /**
     *@test
     */
    public function the_prev_company_is_required()
    {
        $this->assertRequired('prev_company');
    }

    /**
     *@test
     */
    public function the_previous_company_should_be_under_255_characters()
    {
        $this->assertMaxLength('prev_company');
    }

    /**
     *@test
     */
    public function the_prev_position_is_required()
    {
        $this->assertRequired('prev_position');
    }

    /**
     *@test
     */
    public function the_previous_position_should_be_under_255_characters()
    {
        $this->assertMaxLength('prev_position');
    }

    /**
     *@test
     */
    public function the_university_is_required()
    {
        $this->assertRequired('university');
    }

    /**
     *@test
     */
    public function the_university_should_be_under_255_characters()
    {
        $this->assertMaxLength('university');
    }

    /**
     *@test
     */
    public function the_english_ability_is_required()
    {
        $this->assertRequired('english_ability');
    }

    /**
     *@test
     */
    public function the_english_ability_must_be_poor_or_intermediate_or_excellent()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->json(
            'POST',
            "/postings/{$posting->id}/applications",
            $this->defaultApplicationDetails(['english_ability' => 'neither poor, intermediate, nor excellent'])
        );

        $response->assertStatus(422);
        $this->assertArrayHasKey('english_ability', $response->decodeResponseJson()['errors']);
    }

    /**
     *@test
     */
    public function the_mandarin_ability_is_required()
    {
        $this->assertRequired('mandarin_ability');
    }

    /**
     *@test
     */
    public function the_mandarin_ability_must_be_poor_or_intermediate_or_excellent()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->json(
            'POST',
            "/postings/{$posting->id}/applications",
            $this->defaultApplicationDetails(['mandarin_ability' => 'neither poor, intermediate, nor excellent'])
        );

        $response->assertStatus(422);
        $this->assertArrayHasKey('mandarin_ability', $response->decodeResponseJson()['errors']);
    }

    /**
     *@test
     */
    public function the_qualifications_field_is_required()
    {
        $this->assertRequired('qualifications');
    }

    /**
     *@test
     */
    public function the_skills_field_is_required()
    {
        $this->assertRequired('skills');
    }

    /**
     *@test
     */
    public function the_notes_field_is_nullable()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->json(
            'POST',
            "/postings/{$posting->id}/applications",
            $this->defaultApplicationDetails(['notes' => ''])
        );

        $response->assertStatus(200);
    }

    /**
     *@test
     */
    public function the_avatar_must_be_an_existing_file_id_in_the_application_uploads_table()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->json(
            'POST',
            "/postings/{$posting->id}/applications",
            $this->defaultApplicationDetails(['avatar' => 'NON-EXISTING_ID'])
        );

        $response->assertStatus(422);

        $this->assertArrayHasKey('avatar', $response->decodeResponseJson()['errors']);
    }

    /**
     *@test
     */
    public function the_avatar_is_nullable()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->json(
            'POST',
            "/postings/{$posting->id}/applications",
            $this->defaultApplicationDetails(['avatar' => ''])
        );

        $response->assertStatus(200);
    }

    /**
     *@test
     */
    public function the_cover_letter_must_be_an_existing_file_id_in_the_application_uploads_table()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->json(
            'POST',
            "/postings/{$posting->id}/applications",
            $this->defaultApplicationDetails(['cover_letter' => 'NON-EXISTING_ID'])
        );

        $response->assertStatus(422);

        $this->assertArrayHasKey('cover_letter', $response->decodeResponseJson()['errors']);
    }

    /**
     *@test
     */
    public function the_cover_letter_is_nullable()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->json(
            'POST',
            "/postings/{$posting->id}/applications",
            $this->defaultApplicationDetails(['cover_letter' => ''])
        );

        $response->assertStatus(200);
    }

    /**
     *@test
     */
    public function the_cv_must_be_an_existing_file_id_in_the_application_uploads_table()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->json(
            'POST',
            "/postings/{$posting->id}/applications",
            $this->defaultApplicationDetails(['cv' => 'NON-EXISTING_ID'])
        );

        $response->assertStatus(422);

        $this->assertArrayHasKey('cv', $response->decodeResponseJson()['errors']);
    }

    /**
     *@test
     */
    public function the_cv_is_nullable()
    {
        $posting = factory(Posting::class)->create();
        $response = $this->json(
            'POST',
            "/postings/{$posting->id}/applications",
            $this->defaultApplicationDetails(['cv' => ''])
        );

        $response->assertStatus(200);
    }

    private function assertRequired($field)
    {
        $posting = factory(Posting::class)->create();
        $response = $this->json(
            'POST',
            "/postings/{$posting->id}/applications",
            $this->defaultApplicationDetails([$field => ''])
        );

        $response->assertStatus(422);
        $this->assertArrayHasKey($field, $response->decodeResponseJson()['errors']);
    }

    private function assertMaxLength($field, $max = 256)
    {
        $posting = factory(Posting::class)->create();
        $response = $this->json(
            'POST',
            "/postings/{$posting->id}/applications",
            $this->defaultApplicationDetails([$field => str_repeat('X', $max)])
        );

        $response->assertStatus(422);
        $this->assertArrayHasKey($field, $response->decodeResponseJson()['errors']);
    }

    private function defaultApplicationDetails($overrides = [])
    {
        $default = [
            'first_name'       => 'TEST FIRST NAME',
            'last_name'        => 'TEST LAST NAME',
            'email'            => 'TEST@EMAIL.COM',
            'phone'            => 'TEST PHONE',
            'contact_method'   => 'phone',
            'gender'           => 'female',
            'date_of_birth'    => '01/01/1980',
            'prev_company'     => 'TEST COMPANY',
            'prev_position'    => 'TEST POSITION',
            'university'       => 'TEST UNIVERSITY',
            'qualifications'   => 'TEST QUALIFICATIONS',
            'skills'           => 'TEST SKILLS',
            'english_ability'  => 'excellent',
            'mandarin_ability' => 'poor',
            'notes'            => 'TEST NOTES'
        ];

        return array_merge($default, $overrides);
    }
}