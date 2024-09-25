<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    public function index()
    {
        $event = Event::all();
        return response()->json([
            'status' => true,
            'data' => $event
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif',
            'video' => 'nullable|file|mimes:mp4,avi,mov',
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->name = $request->name;
        $event->desc = $request->desc;


        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = public_path('eventimages');
                $image->move($path, $filename);
                $imagePaths[] = 'eventimages/' . $filename;
            }
            $event->image = json_encode($imagePaths);
        }

        if ($request->hasFile('video')) {
            $filename = time() . '_' . $request->file('video')->getClientOriginalName();
            $path = public_path('eventimages');
            $request->file('video')->move($path, $filename);
            $event->video = 'eventimages/' . $filename;
        }
        $event->save();
        return response()->json([
            'status' => true,
            'data' => $event
        ],200);
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => $event
        ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif',
            'video' => 'nullable|file|mimes:mp4,avi,mov',
        ]);

        $event = Event::findOrFail($id);
        $event->title = $request->title;
        $event->name = $request->name;
        $event->desc = $request->desc;


        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $deleteImage) {
                File::delete(public_path($deleteImage));
            }

            $images = json_decode($event->image);
            $images = array_diff($images, $request->delete_images);
            $event->image = json_encode(array_values($images));
        }

        if ($request->hasFile('images')) {
            $imagePaths = json_decode($event->image) ?? [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = public_path('eventimages');
                $image->move($path, $filename);
                $imagePaths[] = 'eventimages/' . $filename;
            }
            $event->image = json_encode($imagePaths);
        }

        if ($request->has('delete_video')) {
            File::delete(public_path($event->video));
            $event->video = null;
        }

        if ($request->hasFile('video')) {
            if ($event->video) {
                File::delete(public_path($event->video));
            }
            $filename = time() . '_' . $request->file('video')->getClientOriginalName();
            $path = public_path('eventimages');
            $request->file('video')->move($path, $filename);
            $event->video = 'eventimages/' . $filename;
        }
        $event->save();
        return response()->json([
            'status' => true,
            'data' => $event
        ],200);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->image) {
            $images = json_decode($event->image);
            foreach ($images as $image) {
                File::delete(public_path($image));
            }
        }

        if ($event->video) {
            File::delete(public_path($event->video));
        }

        $event->delete();

        return response()->json([
            'status' => true,
            'data' => $event
        ],200);
    }
}
