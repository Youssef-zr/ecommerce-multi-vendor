<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SlidersDataTable;
use App\Helpers\ImageUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Sliders\StoreSliderRequest;
use App\Http\Requests\Backend\Sliders\UpdateSliderRequest;
use App\Models\Backend\Slider;
use Illuminate\Support\Arr;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SlidersDataTable $datatable)
    {
        return $datatable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {
        $data = Arr::except($request->validated(), 'banner');

        $slider = new Slider;
        $slider->fill($data)->save();

        self::uploadSliderBanner($slider);

        toastr()->success('Slider Has Been Created Successflully!', 'Success');

        return to_route('admin.dashboard.slider.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact("slider"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $data = Arr::except($request->validated(), 'banner');
        $slider->fill($data)->save();

        self::uploadSliderBanner($slider);

        toastr()->success('Slider Has Been Updated Successflully!', 'Success');

        return to_route('admin.dashboard.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $slider = Slider::findOrFail($id);

        if (!empty($slider)) {

            $imageProps = [
                "old_image" => $slider->banner,
                "default" => $slider->banner,
            ];

            ImageUpload::delete($imageProps);

            $slider->delete();

            toastr()->success('Slider Banner Has Been Deleted Successfully', "Success");

            return response()->json(['success' => 'ok'], 200);
        }
    }

    public static function uploadSliderBanner($slider)
    {
        if (request()->hasFile("banner")) {
            $bannerProps = [
                'file' => request()->file('banner'),
                "storagePath" => "uploads/sliders",
                "old_image" => $slider->banner,
                "default" => $slider->banner,
                "height" => 500,
                "width" => 1300,
                "quality" => 80
            ];

            $fileInfo = ImageUpload::update($bannerProps);
            $slider->fill(['banner' => $fileInfo['file_path']])->save();
        }
    }
}
