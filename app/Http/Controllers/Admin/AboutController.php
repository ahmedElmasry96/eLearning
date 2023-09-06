<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Traits\Upload;
use Exception;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    use Upload;

    public function __construct()
    {
        $this->middleware('can:show about', ['only' => ['index']]);
        $this->middleware('can:edit about', ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::first();
        return view('dashboard.about.index', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $about = About::findOrFail($id);
        return view('dashboard.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $about = About::findOrFail($id);
            $about->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            if ($request->image) {
                $this->removeImage($about->image);
                $image = $this->uploadImage($request->image, 'about/');
                $about->update([
                    'image' => $image,
                ]);
            }
            session()->flash('edit');
            return redirect(route('about.index'));
        } catch(Exception $e) {
            session()->flash('error');
            return redirect(route('about.index'));
        }
    }
}
