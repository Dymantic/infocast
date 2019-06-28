<?php

namespace Tests\Feature\Candidates;

use App\Careers\Application;
use App\Careers\ApplicationUpload;
use App\Careers\Posting;
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
        $posting = factory(Posting::class)->create(['title' => 'test posting']);
        $application = factory(Application::class)->create([
            'posting_id' => $posting->id,
            'cover_letter' => $cover_letter->id,
            'cv' => $resume->id,
        ]);


        $response = $this->asLoggedInUser()->postJson("/admin/candidates", [
            'application_id' => $application->id,
        ]);
        $response->assertStatus(302);

        $this->assertDatabaseHas('candidates', [
            'first_name' => $application->first_name,
            'last_name' => $application->last_name,
            'email' => $application->email,
            'phone' => $application->phone,
            'cover_letter' => $cover_letter->id,
            'cv' => $resume->id,
            'position' => 'test posting'
        ]);
    }
}