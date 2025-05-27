<?php
namespace Pm\VisitorTracker;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class VisitorTrackerServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $timestamp = date('Y_m_d_His');
        $this->publishes([
            __DIR__.'/database/migrations/create_visitors_table.php.stub' =>
                database_path("migrations/{$timestamp}_create_visitors_table.php"),
        ], 'migrations');


        $this->publishes([
            __DIR__.'/config/visitor-tracker.php' => config_path('visitor-tracker.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/visitor-tracker.php', 'visitor-tracker'
        );

        AliasLoader::getInstance()->alias(
            'VisitorTracker',
            \Pm\VisitorTracker\Facades\VisitorTracker::class
        );


    }
}
