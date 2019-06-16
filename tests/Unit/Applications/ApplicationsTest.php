<?php


namespace Tests\Unit\Applications;


use App\Careers\Application;
use App\Careers\ApplicationUpload;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ApplicationsTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function creates_a_trackable_candidate()
    {
        $application = factory(Application::class)->create();

        $candidate = $application->track();

        $this->assertEquals($application->id, $candidate->application_id);
        $this->assertEquals($application->first_name, $candidate->first_name);
        $this->assertEquals($application->last_name, $candidate->last_name);
        $this->assertEquals($application->phone, $candidate->phone);
        $this->assertEquals($application->email, $candidate->email);
    }

    /**
     *@test
     */
    public function a_candidates_files_are_not_cleared_if_application_has_been_deleted()
    {
        Storage::fake('application_uploads_fake');

        $letter = ApplicationUpload::coverLetter(UploadedFile::fake()->create('letter.txt'));
        $letter->created_at = Carbon::today()->subDays(3);
        $letter->save();
        $resume = ApplicationUpload::resume(UploadedFile::fake()->create('resume.txt'));
        $resume->created_at = Carbon::today()->subDays(3);
        $resume->save();
        $application = factory(Application::class)->create([
            'cover_letter' => $letter->id,
            'cv' => $resume->id
        ]);

        $candidate = $application->track();

        $application->delete();

        Artisan::call('application_uploads:clear');

        Storage::disk('application_uploads_test')->assertExists($letter->file_path);
    }
}