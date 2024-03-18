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


        return view('admin.kategori.index', [
            'data' => Kategori::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => ['required'],
        ]);

        if ($validated) {
            Kategori::create($validated);
        }

        return redirect()->route('admin.kategori.index')->with(
            'notifikasi',
            'Berhasil Ditambah'
        );
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
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $id = $kategori->id;
        $destroyKategori = $kategori->findOrFail($id);
        if ($destroyKategori->delete()) {
            return redirect()->route('admin.kategori.index')->with(
                'notifikasi',
                'Berhasil Dihapus'
            );
        } else {
            return response()->json(['message' => 'Gagal dihapus'], 400);
        }
    }
}
