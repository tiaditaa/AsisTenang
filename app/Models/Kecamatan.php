<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';
    protected $fillable = ['nama_kec', 'id_kota'];

    public function alamat() {
        return $this->belongsTo(Alamat::class);
    }
}
