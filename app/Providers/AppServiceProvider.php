<?php

namespace App\Providers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        Carbon::setLocale('id');

        // Share official Contact info with all frontend views and footer
        View::composer(['layouts.frontend', 'components.frontend.footer', 'frontend.*'], function ($view) {
            $contact = null;
            if (Schema::hasTable('contacts')) {
                $contact = Contact::first();
            }
            $view->with('contact', $contact);
        });
    }
}
