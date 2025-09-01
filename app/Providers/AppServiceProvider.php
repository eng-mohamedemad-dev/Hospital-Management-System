<?php

namespace App\Providers;

use App\Interfaces\Doctor\DoctorAuthInterface;
use App\Interfaces\Doctor\DoctorPasswordInterface;
use App\Interfaces\Doctor\DoctorVerifyInterface;
use App\Interfaces\Patient\PatientAuthInterface;
use App\Interfaces\Patient\PatientPasswordInterface;
use App\Interfaces\Patient\PatientVerifyInterface;
use App\Interfaces\Patient\ReviewInterface;
use App\Interfaces\Patient\HomeInterface;
use App\Models\Doctor;
use App\Models\Patient;
use App\Services\Doctor\DoctorAuthService;
use App\Services\Doctor\DoctorPasswordService;
use App\Services\Doctor\DoctorVerifyService;
use App\Services\Patient\PatientAuthService;
use App\Services\Patient\PatientPasswordService;
use App\Services\Patient\PatientVerifyService;
use App\Services\Patient\ReviewService;
use App\Services\Patient\HomeService;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DoctorAuthInterface::class, DoctorAuthService::class);
        $this->app->bind(PatientAuthInterface::class, PatientAuthService::class);
        $this->app->bind(DoctorVerifyInterface::class, DoctorVerifyService::class);
        $this->app->bind(PatientVerifyInterface::class, PatientVerifyService::class);
        $this->app->bind(DoctorPasswordInterface::class, DoctorPasswordService::class);
        $this->app->bind(PatientPasswordInterface::class, PatientPasswordService::class);
        $this->app->bind(ReviewInterface::class, ReviewService::class);
        $this->app->bind(HomeInterface::class, HomeService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'doctor' => Doctor::class,
            'patient' => Patient::class,
        ]);
    }
}
