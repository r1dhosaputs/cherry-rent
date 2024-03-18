<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Kostum;
use Illuminate\Http\Request;

class PengunjungController extends Controller
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

    /**
     * Display a listing of the resource.
     */
    public function index(Slider $slider)
    {
        // return Kostum::get();

        // return $dataSlider = $slider->get();

        $slider = Slider::get();
        
        if ($slider->isEmpty()) {
            $slider = [
                0 => [
                    'slider_1' => 'noimage',
                    'slider_2' => 'noimage',
                    'slider_3' => 'noimage',
                ],
            ];
        }

        $kostumTerbaru = Kostum::latest('created_at')->limit(4)->get();
        return view('pengunjung.home', [
            'slider' =>  $slider,
            'new_kostum' => $kostumTerbaru,
        ]);
    }

    public function kostum(Request $request)
    {
        // return $request;

        // dd(request('s'));
        $kostum = Kostum::latest();

        // Search
        if ($request->s) {
            $kostum->where('nama_kostum', 'like', '%' . request('s') . '%');
        }
        // jika ada pencarian if jalan dulu baru get

        return view('pengunjung.kostum', [
            'ukuran' => $this->ukuran,
            'data' => $kostum->paginate(2)->withQueryString(),
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
