<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdateVideoRequest;
use App\Models\Course;
use App\Models\Video;
use App\Traits\Upload;
use Exception;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    use Upload;

    public function __construct()
    {
        $this->middleware('can:show videos', ['only' => ['index']]);
        $this->middleware('can:create video', ['only' => ['create', 'store']]);
        $this->middleware('can:delete video', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::all();
        return view('dashboard.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('dashboard.videos.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $course = Course::findOrFail($request->course);
            foreach($request->videos as $video) {
                Video::create([
                    'video' => $this->uploadVideo($video, 'videos/' . $course->name),
                    'course_id' => $request->course,
                ]);
            }
            session()->flash('add');
            return redirect(route('videos.index'));
        } catch (Exception $e) {
            return $e->getMessage();
            session()->flash('error');
            return redirect(route('videos.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $video = video::findOrFail($id);
            $this->removeImage($video->video);
            $video->delete();
            session()->flash('delete');
            return redirect(route('videos.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('videos.index'));
        }
    }
}
