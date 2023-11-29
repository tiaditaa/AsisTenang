<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    public function index() {
        $kotaList = Kota::pluck('nama_kota', 'id');
        return view('nama_tampilan', compact('kotaList'));
    }
}
