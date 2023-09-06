<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreServiceRequest;
use App\Http\Requests\Dashboard\UpdateServiceRequest;
use App\Models\Service;
use App\Traits\Upload;
use Exception;

class ServiceController extends Controller
{
    use Upload;

    public function __construct()
    {
        $this->middleware('can:show services', ['only' => ['index']]);
        $this->middleware('can:create service', ['only' => ['create', 'store']]);
        $this->middleware('can:edit service', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete service', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('dashboard.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        try {
            $service = Service::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            if ($request->image) {
                $image = $this->uploadImage($request->image, 'services/' . $service->id);
                Service::findOrFail($service->id)->update([
                    'image' => $image,
                ]);
            }

            session()->flash('add');
            return redirect(route('services.index'));
        } catch(Exception $e) {
            session()->flash('error');
            return redirect(route('services.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        return view('dashboard.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, string $id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            if ($request->image) {
                $this->removeImage($service->image);
                $image = $this->uploadImage($request->image, 'services/' . $service->id);
                $service->update([
                    'image' => $image,
                ]);
            }

            session()->flash('edit');
            return redirect(route('services.index'));
        } catch(Exception $e) {
            session()->flash('error');
            return redirect(route('services.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $service = Service::findOrFail($id);
            $path = 'services/' . $service->id;
            $this->removeImageFolder($path);
            $service->delete();
            session()->flash('delete');
            return redirect(route('services.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('services.index'));
        }
    }
}
