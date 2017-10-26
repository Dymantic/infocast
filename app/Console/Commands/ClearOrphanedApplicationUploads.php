<?php

namespace App\Console\Commands;

use App\Careers\ApplicationUpload;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ClearOrphanedApplicationUploads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'application_uploads:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all the application uploads that were never associated with a submitted application';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        ApplicationUpload::all()
                         ->filter(function ($upload) {
                             return $upload->created_at->diffInHours(Carbon::now()) > 1;
                         })
                         ->filter(function ($upload) {
                             return !$upload->belongsToSubmittedApplication();
                         })->each->delete();
    }
}
