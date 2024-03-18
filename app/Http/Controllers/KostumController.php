<?php

namespace App\Http\Controllers;

use App\Models\Kostum;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class KostumController extends Controller
{

    protected $ukuran = [
        'XS',
        'S',
        'M',
        'L',
        'XL',
        'XXL',
        'XXXL'
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $ukuran = $this->ukuran;


        return view('admin.kostum.index', [
            'kostum' => Kostum::with('kategori')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nama_kategori = Kategori::pluck('id', 'nama_kategori');

        $kategori = [];

        foreach ($nama_kategori as $nama => $id) {
            $kategori[] = [
                'id' => $id,
                'nama_kategori' => $nama
            ];
        }

        // return $kategori;

        return view('admin.kostum.tambah', [
            'kategori' => $kategori,
            'ukuran' => $this->ukuran,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nama_kostum' => ['required'],
            'harga_kostum' => ['required'],
            'kategori_kostum_id' => ['required'],
            'kode_kostum' => ['required'],
            'ukuran_kostum' => ['required'],
            'status_peminjaman' => ['required', 'numeric', 'in:0,1'], // Hanya menerima nilai 0 atau 1
            'deskripsi_kostum' => ['nullable'],
            'foto_kostum' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'], // Hanya menerima jpg, jpeg, png dan maksimal 2MB
        ]);

        if (!$validated['deskripsi_kostum']) {
            $validated['deskripsi_kostum'] = 'Tidak Ada Deskripsi';
        }

        $path = $request->file('foto_kostum')->store('kostum');

        $validated['foto_kostum'] = $path;
        // $validated['foto_kostum'] = 'storage' $path;

        if (Kostum::create($validated)) {
            return redirect()->route('admin.kostum-list')->with(
                'notifikasi',
                'Berhasil Ditambahkan'
            );
        } else {
            return response()->json(['message' => 'Gagal menambahkan kostum'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kostum $kostum, string $id)
    {
        $result = $kostum->with('kategori')->findOrFail($id);
        // 'kostum' => Kostum::with('kategori')->get(),
        // Ambil nilai updated_at dari model atau dari hasil query
        $updated_at = $result->updated_at;

        // Buat objek Carbon dari kolom updated_at
        $updated_at_date = Carbon::parse($updated_at);

        // Buat teks yang dinamis berdasarkan selisih waktu
        $text = "Last updated " . $updated_at_date->shortRelativeDiffForHumans();

        // return $result;
        return view('admin.kostum.detail', [
            'data' => $result,
            'updated_time' => $text,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kostum $kostum, int $id)
    {
        try {
            $result = $kostum->findOrFail($id);
            $nama_kategori = Kategori::pluck('id', 'nama_kategori');
            $kategori = [];

            foreach ($nama_kategori as $nama => $id) {
                $kategori[] = [
                    'id' => $id,
                    'nama_kategori' => $nama
                ];
            }

            return view('admin.kostum.edit', [
                'kategori' => $kategori,
                'ukuran' => $this->ukuran,
                'data' => $result,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Tidak Ditemukan'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kostum $kostum, string $id)
    {
        try {
            $resultUpdate = $kostum->findOrFail($id);

            $validated = $request->validate([
                'nama_kostum' => ['required'],
                'harga_kostum' => ['required'],
                'kategori_kostum_id' => ['required'],
                'kode_kostum' => ['required'],
                'ukuran_kostum' => ['required'],
                'status_peminjaman' => ['required', 'numeric', 'in:0,1'], // Hanya menerima nilai 0 atau 1
                'deskripsi_kostum' => ['nullable'],
                'foto_kostum' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'], // Hanya menerima jpg, jpeg, png dan maksimal 2MB
            ]);

            if (!$validated['deskripsi_kostum']) {
                $validated['deskripsi_kostum'] = 'Tidak Ada Deskripsi';
            }

            $oldPathImages = $resultUpdate->foto_kostum;
            $validated['foto_kostum'] = $oldPathImages;
            // jika ada request foto baru
            if ($request->file('foto_kostum')) {
                Storage::disk('public')->delete($oldPathImages);
                $newPathImages = $request->file('foto_kostum')->store('kostum');
                $validated['foto_kostum'] = $newPathImages;
            }


            if ($validated && $resultUpdate) {
                $resultUpdate->update($validated);

                return redirect()->route('admin.kostum-list')->with(
                    'notifikasi',
                    'Berhasil Diedit'
                );
                // ->setStatusCode(200);
            } else {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mengedit data'], 500);
        }

        // $path = $request->file('foto_kostum')->store('kostum');

        // $validated['foto_kostum'] = $path;

        // if ($validated) {
        //     $resultUpdate->update($validated);
        //     return redirect()->route('admin.kostum-list')->with(
        //         'notifikasi',
        //         'Berhasil Ditambahkan'
        //     );
        // } else {
        //     return response()->json(['message' => 'Gagal menambahkan kostum'], 400);
        // }


        // $bukuToUpdate = $mbuku->findOrFail($id);

        // $validate = $request->validate([
        //     'kode_buku' => ['required', 'min:5', 'max:12', 'unique:buku,kode_buku,' . $id],
        //     'judul_buku' => ['required'],
        //     'jenis_buku' => ['required'],
        //     'pengarang' => ['required'],
        //     'tahun_terbit' => ['required'],
        //     'status_buku' => ['required'],
        // ]);

        // if ($validate) {
        //     $bukuToUpdate->update($validate);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kostum $kostum, string $id)
    {
        //
        // $resultDestroy = $kostum->findOrFail($id);
        // $pathImages = $resultDestroy->foto_kostum;

        // if ($resultDestroy) {
        //     Storage::disk('public')->delete($pathImages);
        //     $resultDestroy->delete;
        // }

        // return redirect()->route('admin.kostum-list')->with(
        //     'notifikasi',
        //     'Berhasil Dihapus'
        // );

        try {
            $resultDestroy = $kostum->findOrFail($id);

            if ($resultDestroy) {
                $pathImages = $resultDestroy->foto_kostum;
                Storage::disk('public')->delete($pathImages);
                $resultDestroy->delete();
                return redirect()->route('admin.kostum-list')->with(
                    'notifikasi',
                    'Berhasil Dihapus'
                );
            } else {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data'], 500);
        }
    }

    // public function tambah_kategori () {

    // }
}
