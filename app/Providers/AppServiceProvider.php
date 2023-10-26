<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Paginator::useBootstrap();

        Validator::extend('datetime_greater_than_now', function ($attribute, $value, $parameters, $validator) {
            // Parse the input date and time as a Carbon instance
            $inputDateTime = \Carbon\Carbon::parse($value);

            // Compare the input date and time with the current date and time
            return $inputDateTime > now();
        });
    }
}
