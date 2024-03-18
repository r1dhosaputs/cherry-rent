<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Kostum;
use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Response;

class PeminjamanController extends Controller
{



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
        $data = Peminjaman::with('kostum')->get();

        return view('admin.peminjaman.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $client = new Client();

        try {
            $response = $client->get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
            $provinsiAPI = json_decode($response->getBody(), true);

            return view('admin.peminjaman.tambah', [
                'kostum' => Kostum::get(),
                'provinsi' => $provinsiAPI,
            ]);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorData = json_decode($e->getResponse()->getBody(), true);
                // Anda dapat menangani berbagai jenis kesalahan berdasarkan kode status di sini
                return response()->json(['error' => $errorData['message'] ?? 'Terjadi kesalahan saat mengakses API'], $statusCode);
            } else {
                // Kesalahan tanpa respon
                return response()->json(['error' => 'Terjadi kesalahan saat mengakses API'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kostum_id' => ['required'],
            'nomor_identitas_peminjam' => ['required'],
            'nama_peminjam' => ['required'],
            'nomor_hp_peminjam' => ['required'],
            'sosial_media_peminjam' => ['required'],
            'alamat_peminjam' => ['required'],
            'alamat_peminjam_2' => ['required'],
            'alamat_peminjam_3' => ['required'],
            'lama_meminjam' => ['required'],
            'tanggal_peminjaman' => ['required', 'date'],
            'tanggal_pengembalian' => ['nullable', 'date'],
            'data_peminjam.*' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:10240'],
        ]);

        $paths = [];

        foreach ($request->file('data_peminjam') as $file) {
            $path = $file->store('peminjam');
            $paths[] = $path;
        }

        // if (!$request->tanggal_pengembalian) {
        //     $validated['tanggal_pengembalian'] = $validated['']
        // }

        $validated['data_peminjam'] = implode(',', $paths);
        if ($validated) {
            $updateStatus = Kostum::findOrFail($validated['kostum_id']);
            $updateStatus->update(['status_peminjaman' => 0]); // dipinjam

        }

        if (Peminjaman::create($validated)) {
            return redirect()->route('admin.peminjaman-list')->with(
                'notifikasi',
                'Berhasil Ditambahkan'
            );
        } else {
            return response()->json(['message' => 'Gagal menambahkan peminjaman'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman, string $id)
    {
        $result = $peminjaman->findOrFail($id);

        return view('admin.peminjaman.detail', [
            'data' => $result,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman, Kostum $kostum)
    {

        $kostum_id = $request->kostum_id;
        $updateStatus = $kostum->findOrFail($kostum_id);

        $updateStatus->update(['status_peminjaman' => 1]);

        $id = $request->id;

        $validated = $request->validate([
            'tanggal_pengembalian' => ['required', 'date'],
        ]);

        $peminjaman = Peminjaman::where('id', $id)->firstOrFail();

        if ($peminjaman->update($validated)) {
            return redirect()->route('admin.peminjaman-list')->with(
                'notifikasi',
                'Berhasil Dikembalikan'
            );
        } else {
            return response()->json(['message' => 'Gagal mengembalikan kostum'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman, Request $request, Kostum $kostum)
    {
        if ($request->id) {

            $id = $request->id;
            $resultDestroy = $peminjaman->findOrFail($id);
            if ($resultDestroy) {

                $kostum_id = $request->kostum_id;
                $updateStatus = $kostum->findOrFail($kostum_id);
                $updateStatus->update(['status_peminjaman' => 1]);
                $resultDestroy->delete();

                return redirect()->route('admin.peminjaman-list')->with(
                    'notifikasi',
                    'Berhasil Dihapus'
                );
            } else {
                return response()->json(['message' => 'Gagal menghapus peminjaman'], 400);
            }
        }
    }
}
