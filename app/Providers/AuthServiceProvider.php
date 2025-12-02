<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Deal;
use App\Policies\DealPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use \App\Policies\ContactPolicy;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        \App\Models\Contact::class=> ContactPolicy::class,
        Deal::class => DealPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
