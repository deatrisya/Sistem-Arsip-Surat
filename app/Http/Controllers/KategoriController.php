<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastId = Kategori::orderBy('id', 'desc')->first();
        $nextId = $lastId ? $lastId->id + 1 : 1;
        return view('kategori.create', compact('nextId'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function data(Request $request)
    {
        $kategori = Kategori::where('id', '!=', 'null');
        return datatables($kategori)
            ->addIndexColumn()
            ->addColumn('options', function ($row) {
                $act['edit'] = route('kategori.edit', ['kategori' => $row->id]);
                $act['delete'] = route('kategori.destroy', ['kategori' => $row->id]);
                $act['data'] = $row;

                return view('kategori.options', $act)->render();
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'nama_kategori' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
                    'keterangan' => 'required|string|max:1000'
                ],
                [
                    'nama_kategori.required' => 'Nama kategori wajib diisi.',
                    'nama_kategori.regex' => 'Nama kategori hanya boleh berisi huruf.',
                    'nama_kategori.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
                    'keterangan.required' => 'Keterangan wajib diisi.',
                    'keterangan.string' => 'Keterangan harus berupa teks.',
                    'keterangan.max' => 'Keterangan tidak boleh lebih dari 1000 karakter.'
                ]
            );

            $kategori = new Kategori;
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->keterangan = $request->keterangan;
            $kategori->save();
            return redirect()->route('kategori.index')->with('toast_success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('toast_error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'nama_kategori' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
                    'keterangan' => 'required|string|max:1000'
                ],
                [
                    'nama_kategori.required' => 'Nama kategori wajib diisi.',
                    'nama_kategori.regex' => 'Nama kategori hanya boleh berisi huruf.',
                    'nama_kategori.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
                    'keterangan.required' => 'Keterangan wajib diisi.',
                    'keterangan.string' => 'Keterangan harus berupa teks.',
                    'keterangan.max' => 'Keterangan tidak boleh lebih dari 1000 karakter.'
                ],
            );
            $kategori = Kategori::find($id);
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->keterangan = $request->keterangan;
            $kategori->save();
            return redirect()->route('kategori.index')->with('toast_success', 'Data berhasil diperbaharui');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('toast_error', 'Data gagal diperbaharui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        if ($kategori->arsip()->exists()) {
            return redirect()->route('kategori.index')->with('toast_error', 'Data tidak dapat dihapus karena berkorelasi dengan data arsip');
        } else {
            $kategori->delete();
            return redirect()->route('kategori.index')->with('toast_success', 'Data berhasil dihapus');
        }
    }
}
