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
    // protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_image'
    ];

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

    // public function Alamat()
    // {
    //     $this->hasMany(Alamat::class, 'nama_alamat', 'provinsi', 'kota', 'kecamatan', 'kode_pos', 'alamat_lengkap');
    // }

    // public function Asisten()
    // {
    //     return $this->hasMany(Asisten::class, 'nama_asisten', 'layanan', 'jenis_kelamin', 'ketersediaan');
    // }
}
