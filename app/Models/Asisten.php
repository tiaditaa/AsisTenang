<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asisten extends Model
{
    use HasFactory;

    protected $fillable = ['nama_asisten', 'layanan', 'jenis_kelamin', 'ketersediaan'];
    protected $table = 'asistens';
    
    public function Asisten()
    {
        return $this->hasMany(Asisten::class, 'nama_asisten', 'layanan', 'jenis_kelamin', 'ketersediaan');
    }
}
