<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
//use Illuminate\Support\Facades\View;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manager', function ($user) {
            return $user->roles()->where('name', 'manager')->count() > 0;
        });
        //
        Gate::define('admin', function ($user) {
            return $user->roles()->where('name', 'admin')->count() > 0;
        });

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Подтвердите адрес электронной почты')
                ->line('Пожалуйста, нажмите на кнопку ниже, чтобы подтвердить свой адрес электронной почты.')
                ->action('Подтвердить email', $url);
        });
    }
}
