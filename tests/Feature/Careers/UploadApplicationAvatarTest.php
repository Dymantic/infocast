<?php


namespace Tests\Feature\Careers;


use App\Careers\ApplicationUpload;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UploadApplicationAvatarTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function an_image_can_be_uploaded_as_an_applicants_avatar()
    {
        $this->disableExceptionHandling();

        $response = $this->json('POST', "/applications/uploads/avatars", [
            'avatar' => UploadedFile::fake()->image('avatar.png')
        ]);
        $response->assertStatus(201);

        $this->assertArrayHasKey('file_id', $response->decodeResponseJson());
        $avatar_id = $response->decodeResponseJson()['file_id'];
        $this->assertDatabaseHas('application_uploads', [
            'file_id' => $avatar_id,
            'file_type' => 'avatar'
        ]);

        $file_path = public_path('application_uploads_test/') . ApplicationUpload::where('file_id',
                $avatar_id)->first()->file_path;

        $this->assertTrue(file_exists($file_path));
    }

    /**
     *@test
     */
    public function the_avatar_file_is_required()
    {
        $response = $this->json('POST', "/applications/uploads/avatars", [
            'avatar' => ''
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('avatar', $response->decodeResponseJson()['errors']);
    }

    /**
     *@test
     */
    public function the_avatar_must_be_a_valid_image_file()
    {
        $response = $this->json('POST', "/applications/uploads/avatars", [
            'avatar' => UploadedFile::fake()->create('textfile.txt')
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('avatar', $response->decodeResponseJson()['errors']);
    }

    /**
     *@test
     */
    public function the_avatar_file_cannot_be_over_2mb()
    {
        $response = $this->json('POST', "/applications/uploads/avatars", [
            'avatar' => UploadedFile::fake()->create('avatar.jpg', 3000)
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('avatar', $response->decodeResponseJson()['errors']);
    }
}