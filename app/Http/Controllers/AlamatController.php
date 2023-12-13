<?php

namespace App\Http\Controllers;

use App\Exports\AlamatExport;
use App\Models\Kota;
use App\Models\Alamat;
use App\Models\Provinsi;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class AlamatController extends Controller
{
    public function show()
    {
        $show = Alamat::all();
        return view('page.admin.pelanggan.show', ['page.admin.pelanggan.show'=>$show]);
    }

    public function exportExcel() {
        return Excel::download(new AlamatExport, 'alamat.xlsx');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        try {
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
        } catch (QueryException $e) {
            Log::error("Error storing data: " . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan dalam menyimpan data');
        }
    }

    public function getAlamat(Request $request)
    {
        try {
            if (!$request->ajax() || !$request->isMethod('post')) {
                throw new \Exception('Invalid request method or not an AJAX request.');
            }

            $alamat = Alamat::select(['id','id_penyewa', 'id_provinsi', 'id_kecamatan', 'id_kota', 'nama_alamat', 'kode_pos', 'alamat_lengkap'])->get();

            return DataTables::of($alamat)
                ->addColumn('action', function ($alamat) {
                    $urlHapus = route('alamat.delete', $alamat->id);
                    return '<a href="' . $urlHapus . '" class="btn btn-danger">Hapus</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function ubahAlamat($id, Request $request)
    {
        try {
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

                return redirect()->route('alamat.edit', ['id' => $alamat->id])->with('status', 'Data telah tersimpan di database');
            }

            $provinsiList = Provinsi::all();
            $kotaList = Kota::all();
            $kecList = Kecamatan::all();
            return view('page.admin.pelanggan.ubahAlamat', ['alamat' => $alamat], compact('provinsiList', 'kotaList', 'kecList'));

        } catch (ModelNotFoundException $e) {
            return redirect()->route('alamat.index')->with('error', 'Alamat tidak ditemukan');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions if needed
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function hapusAlamat($id)
    {
        try {
            $alamat = Alamat::findOrFail($id);
            $alamat->delete();

            return response()->json([
                'msg' => 'Data yang dipilih telah dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }


}
