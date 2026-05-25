<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\Events\Looping;
use Illuminate\Queue\Events\WorkerStopping;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        Model::shouldBeStrict();
        Model::automaticallyEagerLoadRelationships();
        Model::unguard();

        DB::prohibitDestructiveCommands(app()->isProduction());

        Date::use(CarbonImmutable::class);

        URL::forceHttps(app()->isProduction() || app()->environment('stage'));

        Event::listen(Looping::class, fn () => Log::warning('[queue-debug] Looping iteration', ['pid' => getmypid(), 'mem_mb' => round(memory_get_usage(true) / 1048576, 1)]));
        Event::listen(WorkerStopping::class, fn (WorkerStopping $e) => Log::warning('[queue-debug] WorkerStopping', ['pid' => getmypid(), 'status' => $e->status, 'mem_mb' => round(memory_get_usage(true) / 1048576, 1)]));
    }
}
