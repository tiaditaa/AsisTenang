<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $fillable = ['nama_alamat', 'provinsi', 'kota', 'kecamatan', 'kode_pos', 'alamat_lengkap'];
    protected $table = 'alamat';

    public function Alamat()
    {
        $this->hasMany(Alamat::class, 'nama_alamat', 'provinsi', 'kota', 'kecamatan', 'kode_pos', 'alamat_lengkap');
    }
}
