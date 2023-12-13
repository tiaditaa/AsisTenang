<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Asisten;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\PDF;

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
        try {
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
        } catch (QueryException $e) {
            Log::error("Error storing data: " . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan dalam menyimpan data');
        }
    } 

    public function getAsisten(Request $request)
    {
        try {
            if (!$request->ajax() || !$request->isMethod('post')) {
                throw new \Exception('Invalid request method or not an AJAX request.');
            }

            $asisten = Asisten::select(['id', 'nama_asisten', 'layanan', 'jenis_kelamin', 'ketersediaan'])->get();

            return DataTables::of($asisten)
                ->addColumn('action', function ($asisten) {
                    $urlHapus = route('asisten.delete', $asisten->id);
                    return '<a href="' . $urlHapus . '" class="btn btn-danger">Hapus</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function ubahAsisten(Request $request, $id)
    {
        try {
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
        } catch (ModelNotFoundException $e) {
            return redirect()->route('asisten.index')->with('error', 'Alamat tidak ditemukan');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions if needed
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function hapusAsisten($id)
    {
        try {
            $asisten = Asisten::findOrFail($id);
            $asisten->delete();

            return response()->json([
                'msg' => 'Data yang dipilih telah dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function pilih()
    {
        // Assuming you have a model named Asisten and want to fetch data
        $dataAsisten = Asisten::all();

        return view('page.admin.pilihAsisten.pilihAsisten', compact('dataAsisten'));
    }

    public function downloadPDF()
    {
        $user = Auth::id();
        $dataAlamat = Alamat::where('id', 1)->get();
        $dataAsisten = Asisten::find($user);

        $data = [
            'dataUser' => $user,
            'dataAlamat' => $dataAlamat, // This assumes that the 'alamat' relationship returns a collection
            'dataAsisten' => $dataAsisten,
        ];

        // Create an instance of the PDF class
        $pdf = app('dompdf.wrapper');

        // Set options for this specific PDF instance
        $pdf->setOptions([
            'dpi' => 150,
            'defaultFont' => 'Roboto'
        ]);

        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait'); // Adjust 'A4' and 'portrait' based on your requirements

        // Load the view
        $pdf->loadView('kontrak', $data);

        // Download the PDF
        return $pdf->stream('kontrak.pdf', array('Attachment' => false));
    }


}
