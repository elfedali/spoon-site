<?php

namespace App\Http\Controllers\Account\Place;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    // upload image to $place using spatie media library
    public function store(Request $request, Place $place)
    {
        $request->validate([
            'image' => ['required', 'image'],
        ]);

        $place->addMedia($request->file('image'))
            ->toMediaCollection('gallery');

        return back()->with('success', __('label.image_uploaded'));
    }

    // delete image from $place using spatie media library
    public function destroy(Place $place, $mediaId)
    {
        $place->deleteMedia($mediaId);

        return back()->with('success', __('label.image_deleted'));
    }

    // show gallery of $place

    public function __invoke(Place $place)
    {
        $gallery = $place->getMedia('gallery');

        // dd($gallery);

        return view('place.gallery.index', compact('place', 'gallery'));
    }
}
