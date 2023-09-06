<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreSliderRequest;
use App\Http\Requests\Dashboard\UpdateSliderRequest;
use App\Models\Slider;
use App\Traits\Upload;
use Exception;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use Upload;

    public function __construct()
    {
        $this->middleware('can:show sliders', ['only' => ['index']]);
        $this->middleware('can:create slider', ['only' => ['create', 'store']]);
        $this->middleware('can:edit slider', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete slider', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('dashboard.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {
        try {
            $slider = Slider::create([
                'slogan' => $request->slogan,
                'title' => $request->title,
                'paragraph' => $request->paragraph,
                'button_title' => $request->button_title,
            ]);

            if ($request->image) {
                $image = $this->uploadImage($request->image, 'sliders/' . $slider->id);
                Slider::findOrFail($slider->id)->update([
                    'image' => $image,
                ]);
            }

            session()->flash('add');
            return redirect(route('sliders.index'));
        } catch(Exception $e) {
            session()->flash('error');
            return redirect(route('sliders.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('dashboard.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, string $id)
    {
        try {
            $slider = Slider::findOrFail($id);
            $slider->update([
                'slogan' => $request->slogan,
                'title' => $request->title,
                'paragraph' => $request->paragraph,
                'button_title' => $request->button_title,
            ]);

            if ($request->image) {
                $this->removeImage($slider->image);
                $image = $this->uploadImage($request->image, 'sliders/' . $slider->id);
                $slider->update([
                    'image' => $image,
                ]);
            }
            session()->flash('edit');
            return redirect(route('sliders.index'));
        } catch(Exception $e) {
            session()->flash('error');
            return redirect(route('sliders.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $slider = Slider::findOrFail($id);
            $path = 'sliders/' . $slider->id;
            $this->removeImageFolder($path);
            $slider->delete();
            session()->flash('delete');
            return redirect(route('sliders.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('sliders.index'));
        }
    }
}
