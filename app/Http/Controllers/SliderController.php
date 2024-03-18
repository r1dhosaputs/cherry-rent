<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

define("ID", 1);

class SliderController extends Controller
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
        // Slider::pluck('slider_1');

        // $slider = [
        //     'slider_1' => Slider::pluck('slider_1'),
        //     'slider_2' => Slider::pluck('slider_2'),
        //     'slider_3' => Slider::pluck('slider_3'),
        // ];
        $data = Slider::get();

        if ($data->isEmpty()) {
            $data = [
                0 => [
                    'slider_1' => 'noimage',
                    'slider_2' => 'noimage',
                    'slider_3' => 'noimage',
                ],
            ];
        }

        // return $data;

        return view('admin.slider.index', [
            'data' => $data,
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
    public function update_image(Request $request)
    {
        // define("ID", 1);

        // Temukan data Slider berdasarkan ID
        $updateSlider = Slider::findOrFail(ID);

        $sliders = ['slider_1', 'slider_2', 'slider_3'];
        $fileUploaded = false;

        $request->validate([
            'slider_1' => ['file', 'mimes:jpg,jpeg,png', 'max:5120'],
            'slider_2' => ['file', 'mimes:jpg,jpeg,png', 'max:5120'],
            'slider_3' => ['file', 'mimes:jpg,jpeg,png', 'max:5120'],
        ]);

        foreach ($sliders as $slider) {
            if ($request->hasFile($slider)) {
                $fileUploaded = true;
                $currentSlider = $slider;
                $filePath = $request->file($currentSlider)->store('slider');
            }
        }

        if ($fileUploaded) {
            $updateSlider->update([
                $currentSlider => $filePath
            ]);
            // return response()->json(['message' => 'berhsl'], 200);
            return redirect()->route('admin.home-slider')->with('notifikasi', 'Gambar untuk ' . $currentSlider . ' berhasil ditambah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_update(Request $request)
    {
        try {
            $updateSlider = Slider::findOrFail(ID);

            $index = 0;

            if ($request->allslider === 'slider_1') {
                $index = 1;
                Storage::disk('public')->delete($updateSlider['slider_1']);
                $updateSlider->update([
                    'slider_1' => 'noimage'
                ]);
            } else if ($request->allslider === 'slider_2') {
                $index = 2;
                Storage::disk('public')->delete($updateSlider['slider_2']);
                $updateSlider->update([
                    'slider_2' => 'noimage'
                ]);
            } else if ($request->allslider === 'slider_3') {
                $index = 3;
                Storage::disk('public')->delete($updateSlider['slider_3']);
                $updateSlider->update([
                    'slider_3' => 'noimage'
                ]);
            }

            // return 'data ' . $index;

            return redirect()->route('admin.home-slider')
                ->with('notifikasi', 'Slider ' . $index . ' berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Kolom Slider tidak Sesuai'], 404);
        }
    }
}
