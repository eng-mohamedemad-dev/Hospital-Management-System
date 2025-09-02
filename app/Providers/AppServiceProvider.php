<?php

namespace App\Providers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Services\Patient\HomeService;
use App\Services\Patient\ReviewService;
use Illuminate\Support\ServiceProvider;
use App\Services\Doctor\ProfileServices;
use App\Interfaces\Patient\HomeInterface;
use App\Services\Doctor\DoctorAuthService;
use App\Interfaces\Doctor\ProfileInterface;
use App\Interfaces\Patient\ReviewInterface;
use App\Services\Doctor\AppointmentService;
use App\Services\Doctor\DoctorVerifyService;
use App\Services\Patient\PatientAuthService;
use App\Interfaces\Doctor\DoctorAuthInterface;
use App\Services\Doctor\DoctorPasswordService;
use App\Services\Patient\PatientVerifyService;
use App\Interfaces\Doctor\AppointmentInterface;
use App\Interfaces\Doctor\DoctorVerifyInterface;
use App\Interfaces\Patient\PatientAuthInterface;
use App\Services\Patient\PatientPasswordService;
use App\Interfaces\Doctor\DoctorPasswordInterface;
use App\Interfaces\Patient\PatientVerifyInterface;
use App\Interfaces\Patient\PatientPasswordInterface;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        $this->app->bind(AppointmentInterface::class, AppointmentService::class);
        $this->app->bind(ProfileInterface::class, ProfileServices::class);
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
