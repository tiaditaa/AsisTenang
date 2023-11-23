<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_provinsi'];

    public function alamat() {
        return $this->belongsTo(Alamat::class);
    }
}
