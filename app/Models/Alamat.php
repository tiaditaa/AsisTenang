<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $fillable = ['nama_alamat', 'id_penyewa', 'id_provinsi', 'id_kota', 'id_kecamatan', 'kode_pos', 'alamat_lengkap'];
    protected $table = 'alamat';

    public function provinsi() {
        return $this->hasOne(Provinsi::class);
    }

    public function kota() {
        return $this->hasOne(Kota::class);
    }

    public function kecamatan() {
        return $this->hasOne(Kecamatan::class);
    }
}
