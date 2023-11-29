<?php

namespace App\Http\Controllers;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function index()
    {
        $provinsiList = Provinsi::pluck('nama_provinsi', 'id');
        return view('nama_tampilan', compact('provinsiList'));
    }
}
