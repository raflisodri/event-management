<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'foto',
        'name',
        'email',
        'password',
        'mulai_kontrak',
        'selesai_kontrak',
        'unit_bisnis',
        'jabatan',
        'nik',
        'no_telp',
        'gender',
        'status',
        'alamat',
        'nama_emergency',
        'hubungan',
        'no_telp_emergency',
    ];

    public function unitBisnis()
    {
        return $this->belongsTo(UnitBisnis::class, 'unit_bisnis', 'id');
    }

    public function acaras()
    {
        return $this->hasMany(Acara::class, 'koordinator', 'id');
    }
    public function partisipan()
    {
        return $this->hasMany(Partisipan::class, 'user_id', 'id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
