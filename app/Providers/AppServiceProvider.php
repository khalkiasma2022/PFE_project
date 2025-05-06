<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\NotificationGenarale; // ATTENTION au nom de ton modèle
use Illuminate\Support\Facades\Auth;

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
        View::composer('*', function ($view) {
            if (Auth::guard('responsable')->check()) { // Utiliser le guard responsable
                $responsable = Auth::guard('responsable')->user();
                $matricule = $responsable->Matricule_resp ?? null;

                if ($matricule) {
                    $notifications = NotificationGenarale::where('Matricule_responsable_notif', $matricule)
                        ->orderBy('created_at', 'desc')
                        ->get();
                } else {
                    $notifications = collect();
                }
            } else {
                $notifications = collect();
            }

            $view->with('notifications', $notifications);
        });
    }
}
