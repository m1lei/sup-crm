<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Deal;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        //Алиас для заполнения Activity->subject_type, вместо длинных классов, короткие слова
        Relation::enforceMorphMap([
            'deal' => \App\Models\Deal::class,
            'contact' => \App\Models\Contact::class,
        ]);
    }
}
