<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('image')->store('images', 'public');

        $image = new Image();
        $image->user_id = 1;
        $image->path = $path;
        $image->original_name = $request->file('image')->getClientOriginalName();
        $image->save();

        return response()->json(['message' => 'Image uploaded successfully', 'image' => $image], 201);
    }

    public function resize(Request $request, $id)
    {
        $request->validate([
            'width' => 'required|integer',
            'height' => 'required|integer',
        ]);

        $image = Image::findOrFail($id);

        $img = InterventionImage::make(Storage::disk('public')->path($image->path));
        $img->resize($request->width, $request->height);
        $img->save();

        return response()->json(['message' => 'Image resized successfully'], 200);
    }

    public function crop(Request $request, $id)
    {
        $request->validate([
            'width' => 'required|integer',
            'height' => 'required|integer',
            'x' => 'required|integer',
            'y' => 'required|integer',
        ]);

        $image = Image::findOrFail($id);

        $img = InterventionImage::make(Storage::disk('public')->path($image->path));
        $img->crop($request->width, $request->height, $request->x, $request->y);
        $img->save();

        return response()->json(['message' => 'Image cropped successfully'], 200);
    }

    public function rotate(Request $request, $id)
    {
        $request->validate([
            'angle' => 'required|integer',
        ]);

        $image = Image::findOrFail($id);

        $img = InterventionImage::make(Storage::disk('public')->path($image->path));
        $img->rotate($request->angle);
        $img->save();

        return response()->json(['message' => 'Image rotated successfully'], 200);
    }

    public function flip(Request $request, $id)
    {
        $request->validate([
            'direction' => 'required|in:horizontal,vertical',
        ]);

        $image = Image::findOrFail($id);

        $img = InterventionImage::make(Storage::disk('public')->path($image->path));
        $img->flip($request->direction);
        $img->save();

        return response()->json(['message' => 'Image flipped successfully'], 200);
    }

    public function grayscale(Request $request, $id)
    {
        $image = Image::findOrFail($id);

        $img = InterventionImage::make(Storage::disk('public')->path($image->path));
        $img->greyscale();
        $img->save();

        return response()->json(['message' => 'Image converted to grayscale successfully'], 200);
    }
}
