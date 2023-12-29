<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'google_token',
        'email_verified_at',
        'profile_photo_path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function adminlte_image()
    {
        if (auth()->user()->google_id) {
            $foto = auth()->user()->profile_photo_url;

            // Verificar si la URL tiene el prefijo '/storage/'
            if (Str::startsWith($foto, 'http://localhost/storage/')) {
                // Si tiene el prefijo, quitarlo y devolver la URL sin modificar
                return str_replace('http://localhost/storage/', '', $foto);
            }
            return $foto;

        } else {
            if (auth()->user()->profile_photo_url != null) {
                $foto = auth()->user()->profile_photo_url;
                return $foto;
            } else {
                return 'https://picsum.photos/200';
            }
        }
    }

    public function adminlte_desc()
    {
        return 'Administrador';
    }

    public function adminlte_profile_url(){
        return 'profile/username';
    }
}
