<?php

namespace Tests\Feature\Candidates;

use App\Careers\Application;
use App\Careers\ApplicationUpload;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateCandidatesTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function create_from_applicant()
    {
        Storage::fake('application_uploads_test');
        $this->withoutExceptionHandling();

        $cover_letter = ApplicationUpload::coverLetter(UploadedFile::fake()->create('letter.txt'));
        $resume = ApplicationUpload::resume(UploadedFile::fake()->create('resume.txt'));
        $application = factory(Application::class)->create([
            'cover_letter' => $cover_letter->id,
            'cv' => $resume->id,
        ]);


        $response = $this->asLoggedInUser()->postJson("/admin/candidates", [
            'application_id' => $application->id,
        ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('candidates', [
            'first_name' => $application->first_name,
            'last_name' => $application->last_name,
            'email' => $application->email,
            'phone' => $application->phone,
            'cover_letter_id' => $cover_letter->id,
            'resume_id' => $resume->id
        ]);
    }
}