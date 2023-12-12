<?php

namespace App\Http\Controllers;
use App\Models\Kota;
use App\Models\Alamat;
use App\Models\Provinsi;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use DataTables;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AlamatController extends Controller
{
    public function show()
    {
        return view('page.admin.pelanggan.show');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        if ($request->isMethod('post')) {
            Alamat::create([
                'id_penyewa' => $userId,
                'nama_alamat' => $request->nama_alamat,
                'id_provinsi' => $request->id_provinsi,
                'id_kota' => $request->id_kota,
                'id_kecamatan' => $request->id_kecamatan,
                'kode_pos' => 5,
                'alamat_lengkap' => $request->alamat_lengkap,
            ]);
            return redirect()->route('alamat.add')->with('status', 'Data telah tersimpan di database');
        }
        $provinsiList = Provinsi::all();
        $kotaList = Kota::all();
        $kecList = Kecamatan::all();
        return view('page.admin.pelanggan.addAlamat', compact('provinsiList', 'kotaList', 'kecList'));
    }

    public function getAlamat(Request $request)
    {
        if ($request->ajax() && $request->isMethod('post')) {
            $alamat = Alamat::select(['id','id_penyewa', 'id_provinsi', 'id_kecamatan', 'id_kota', 'nama_alamat', 'kode_pos', 'alamat_lengkap'])->get();

            return DataTables::of($alamat)
                ->addColumn('action', function ($alamat) {
                    // $url = route('alamat.edit', ['id' => $alamat->id]);
                    $urlHapus = route('alamat.delete', $alamat->id);
                    return '<a href="' . $urlHapus . '" class="btn btn-danger">Hapus</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return redirect()->route('alamat.getAlamat');
    }

    public function ubahAlamat($id, Request $request)
    {
        $alamat = Alamat::findOrFail($id);
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'id_provinsi' => 'required',
                'id_kota' => 'required',
                'id_kecamatan' => 'required',
                'nama_alamat' => 'required|string',
                'kode_pos' => 'required',
                'alamat_lengkap' => 'required'
            ]);

            $alamat->update([
                'id_provinsi' => $request->id_provinsi,
                'id_kota' => $request->id_kota,
                'id_kecamatan' => $request->id_kecamatan,
                'nama_alamat' => $request->nama_alamat,
                'kode_pos' => $request->kode_pos,
                'alamat_lengkap' => $request->alamat_lengkap
            ]);
            return redirect()->route('alamat.edit',['id' => $alamat->id ])->with('status', 'Data telah tersimpan di database');
        }
        $provinsiList = Provinsi::all();
        $kotaList = Kota::all();
        $kecList = Kecamatan::all();
        return view('page.admin.pelanggan.ubahAlamat', ['alamat' => $alamat], compact('provinsiList', 'kotaList', 'kecList'));
    }

    public function hapusAlamat($id)
    {
        $alamat = Alamat::findOrFail($id);
        $alamat->delete($id);

        return response()->json([
            'msg' => 'Data yang dipilih telah dihapus'
        ]);
    }

}
