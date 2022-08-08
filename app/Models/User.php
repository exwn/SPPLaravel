<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['jurusan_name', 'spp_kelas', 'spp_tagihan', 'profile_photo_url'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    public function spp()
    {
        return $this->belongsTo(Spp::class, 'kelas_id', 'id');
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'users_id', 'id');
    }

    public function getJurusanNameAttribute()
    {
        return "{$this->jurusan->name}";
    }
    public function getSppKelasAttribute()
    {
        return "{$this->spp->id}";
    }
    public function getSppTagihanAttribute()
    {
        return "{$this->spp->total_tagihan}";
    }
}
