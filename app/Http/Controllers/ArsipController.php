<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('arsip.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('arsip.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function data(Request $request)
    {
        $arsip = Arsip::with('kategori');
        return datatables($arsip)
            ->addIndexColumn()
            ->addColumn('options', function ($row) {
                $act['show'] = route('arsip.show', ['arsip' => $row->id]);
                $act['edit'] = route('arsip.edit', ['arsip' => $row->id]);
                $act['download'] = route('arsip.download', ['id' => $row->id]);
                $act['delete'] = route('arsip.destroy', ['arsip' => $row->id]);
                $act['data'] = $row;

                return view('arsip.options', $act)->render();
            })
            ->editColumn('kategori_id', function ($row) {
                return $row->kategori->nama_kategori;
            })
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('d-m-Y H:i');
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'nomor_surat' => 'required|unique:arsips,nomor_surat',
                    'kategori_id' => 'required|exists:kategoris,id',
                    'judul' => 'required|string|max:255',
                    'file_pdf' => 'required|mimes:pdf|max:2048',
                ],
                [
                    'nomor_surat.required' => 'Nomor surat wajib diisi.',
                    'nomor_surat.unique' => 'Nomor surat sudah ada.',
                    'kategori_id.required' => 'Kategori wajib dipilih.',
                    'kategori_id.exists' => 'Kategori tidak valid.',
                    'judul.required' => 'Judul wajib diisi.',
                    'judul.string' => 'Judul harus berupa teks.',
                    'judul.max' => 'Judul tidak boleh lebih dari 255 karakter.',
                    'file_pdf.required' => 'File PDF wajib diunggah.',
                    'file_pdf.mimes' => 'File harus berformat PDF.',
                    'file_pdf.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
                ]
            );
            $arsip = new Arsip();
            $arsip->nomor_surat = $request->nomor_surat;
            $arsip->kategori_id = $request->kategori_id;
            $arsip->judul = $request->judul;

            if ($request->hasFile('file_pdf')) {
                $file_pdf = $request->file('file_pdf');
                $fileName = time() . '_' . $file_pdf->getClientOriginalName();
                $filePath = $file_pdf->storeAs('uploads', $fileName, 'public');
                $arsip->file_pdf = $filePath;
            }

            $arsip->save();
            return redirect()->route('arsip.index')->with('toast_success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('toast_error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $arsip = Arsip::findOrFail($id);
        $kategori = Kategori::all();
        return view('arsip.detail', compact('arsip', 'kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $arsip = Arsip::findOrFail($id);
        $kategori = Kategori::all();
        return view('arsip.edit', compact('arsip', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nomor_surat' => 'required|unique:arsips,nomor_surat,' . $id,
                'kategori_id' => 'required|exists:kategoris,id',
                'judul' => 'required|string|max:255',
                'file_pdf' => 'nullable|mimes:pdf|max:2048',
            ], [
                'nomor_surat.required' => 'Nomor surat wajib diisi.',
                'nomor_surat.unique' => 'Nomor surat sudah ada.',
                'kategori_id.required' => 'Kategori wajib dipilih.',
                'kategori_id.exists' => 'Kategori tidak valid.',
                'judul.required' => 'Judul wajib diisi.',
                'judul.string' => 'Judul harus berupa teks.',
                'judul.max' => 'Judul tidak boleh lebih dari 255 karakter.',
                'file_pdf.mimes' => 'File harus berformat PDF.',
                'file_pdf.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
            ]);
            $arsip = Arsip::findOrFail($id);
            $arsip->nomor_surat = $request->nomor_surat;
            $arsip->kategori_id = $request->kategori_id;
            $arsip->judul = $request->judul;

            if ($request->hasFile('file_pdf')) {
                $file_pdf = $request->file('file_pdf');
                $fileName = time() . '_' . $file_pdf->getClientOriginalName();
                $filePath = $file_pdf->storeAs('uploads', $fileName, 'public');

                // Delete old file if exists
                if ($arsip->file_pdf && Storage::disk('public')->exists($arsip->file_pdf)) {
                    Storage::disk('public')->delete($arsip->file_pdf);
                }

                $arsip->file_pdf = $filePath;
            }
            $arsip->save();
            return redirect()->route('arsip.index')->with('toast_success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('toast_error', 'Data gagal diperbarui');
        }
    }

    public function downloadArsip($id)
    {
        try {
            // Ambil data arsip dari database
            $arsip = Arsip::findOrFail($id);

            // Path file di storage Laravel
            $filePath = $arsip->file_pdf;

            // Periksa apakah file ada di storage
            if (!Storage::disk('public')->exists($filePath)) {
                return response()->json(['error' => 'File not found.'], 404);
            }

            // Ambil path absolut dari file
            $absolutePath = Storage::disk('public')->path($filePath);

            // Berikan tautan untuk mengunduh file
            return response()->file($absolutePath, ['Content-Disposition' => 'attachment; filename="' . $arsip->nomor_surat . '.pdf"']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $arsip = Arsip::find($id);
        $arsip->delete();
        return redirect()->route('arsip.index')->with('toast_success', 'Data berhasil dihapus');
    }
}