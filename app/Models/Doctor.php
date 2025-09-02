<?php

namespace App\Models;
use App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     */
    protected $table = 'doctors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'specialist_id',
        'hospital',
        'about',
        'str',
        'experience',
        'address',
        'image',
        'email',
        'password',
        'reviews_count',
        'reviews_sum',
        'reviews_avg',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all verification codes for this doctor.
     */
    public function verificationCodes(): MorphMany
    {
        return $this->morphMany(VerificationCode::class, 'user');
    }

    public function specialist()
    {
        return $this->belongsTo(Specialist::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
