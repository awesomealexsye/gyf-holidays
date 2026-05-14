<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Helpers\ImageHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register webp() as a global Blade directive
        Blade::directive('webp', function ($expression) {
            return "<?php echo \App\Helpers\ImageHelper::webp($expression); ?>";
        });

        Paginator::useTailwind();
    }
}
