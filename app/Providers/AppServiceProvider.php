<?php

namespace App\Providers;

use App\Http\Controllers\UpdateDbController;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        
        Gate::define('superadmin', function (User $user) {
            return $user->level === 'Superadmin';
        });

        Gate::define('admin', function (User $user) {
            return $user->level === 'Superadmin' || $user->level === 'Admin';
        });

        Gate::define('manager', function (User $user) {
            return $user->level === 'Superadmin' || $user->level === 'Manager';
        });

        Gate::define('mahasiswa', function (User $user) {
            return $user->level === 'Superadmin' || $user->level === 'Manager' || $user->level === 'Mahasiswa';
        });

        Gate::define('teknisi', function (User $user) {
            return $user->level === 'Superadmin' || $user->level === 'Manager' || $user->level === 'Mahasiswa' || $user->level === 'Teknisi';
        });



      
    

    }
}
