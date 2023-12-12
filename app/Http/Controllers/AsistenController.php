<?php

namespace App\Http\Controllers;

use App\Models\Asisten;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class AsistenController extends Controller
{
    public function show()
    {
        return view('page.admin.asisten.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            Asisten::create([
                'nama_asisten' => $request->nama_asisten,
                'layanan' => $request->layanan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'ketersediaan' => $request->ketersediaan
            ]);
            return redirect()->route('asisten.add')->with('status', 'Data telah tersimpan di database');
        }
        return view('page.admin.asisten.addAsisten');
    }

    public function getAsisten(Request $request)
    {
        if ($request->ajax() && $request->isMethod('post')) {
            $asisten = Asisten::select(['id','nama_asisten','layanan','jenis_kelamin','ketersediaan'])->get();

            return DataTables::of($asisten)
                // ->addColumn('action', function ($asisten) {
                //     // $url = route('alamat.edit', ['id' => $alamat->id]);
                //     $urlHapus = route('asisten.delete', $asisten->id);
                //     return '<a href="' . $urlHapus . '" class="btn btn-danger">Hapus</a>';
                // })
                ->rawColumns(['action'])
                ->make(true);
        }
        return redirect()->route('asisten.getAsisten');
    }

    public function ubahAsisten(Request $request, $id)
    {
        $asisten = Asisten::findOrFail($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'nama_asisten' => 'required',
                'layanan' => 'required',
                'jenis_kelamin' => 'required',
                'ketersediaan' => 'required',
            ]);

            $asisten->update([
                'nama_asisten' => $request->nama_asisten,
                'layanan' => $request->layanan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'ketersediaan' => $request->ketersediaan
            ]);

            return redirect()->route('asisten.edit',['id' => $asisten->id ])->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.asisten.ubahAsisten', ['asisten' => $asisten]);
    }

    public function hapusAsisten($id)
    {
        $asisten = Asisten::findOrFail($id);
        $asisten->delete($id);

        return response()->json([
            'msg' => 'Data yang dipilih telah dihapus'
        ]);
    }
}
