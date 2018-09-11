<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Psr\Http\Message\UriInterface;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        SitemapGenerator::create(config('app.url'))
                        ->shouldCrawl(function (UriInterface $url) {
                            return strpos($url->getPath(), 'application') === false;
                        })
                        ->writeToFile(public_path('sitemap.xml'));
    }
}
