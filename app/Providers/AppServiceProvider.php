<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\TranslationRepository;
use App\Repositories\TranslationRepositoryInterface;
use App\Services\TranslationService;
use App\Services\TranslationServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TranslationRepositoryInterface::class, TranslationRepository::class);
        $this->app->bind(TranslationServiceInterface::class, TranslationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
