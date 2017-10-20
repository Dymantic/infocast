<?php

namespace App\Providers;

use App\Secretary;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('activeclass', function ($path_fragment) {
            return "<?php echo starts_with(Request::path(), $path_fragment) ? 'active' : ''; ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('secretary', function() {
           return new Secretary([
               'email' => config('contact.general_email'),
               'slack' => config('contact.slack')
           ]);
        });
    }
}
