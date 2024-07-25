<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;

class ImageUpload extends Component
{
    use WithFileUploads;

    public $image;
    public $path;
    public $width, $height, $x, $y, $angle, $direction;

    public function upload()
    {
        $this->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $this->path = $this->image->store('images', 'public');
        session()->flash('message', 'Image uploaded successfully.');
    }

    public function resize()
    {
        $this->validate([
            'width' => 'required|integer',
            'height' => 'required|integer',
        ]);

        $img = InterventionImage::make(Storage::disk('public')->path($this->path));
        $img->resize($this->width, $this->height);
        $img->save();

        session()->flash('message', 'Image resized successfully.');
    }

    public function crop()
    {
        $this->validate([
            'width' => 'required|integer',
            'height' => 'required|integer',
            'x' => 'required|integer',
            'y' => 'required|integer',
        ]);

        $img = InterventionImage::make(Storage::disk('public')->path($this->path));
        $img->crop($this->width, $this->height, $this->x, $this->y);
        $img->save();

        session()->flash('message', 'Image cropped successfully.');
    }

    public function rotate()
    {
        $this->validate([
            'angle' => 'required|integer',
        ]);

        $img = InterventionImage::make(Storage::disk('public')->path($this->path));
        $img->rotate($this->angle);
        $img->save();

        session()->flash('message', 'Image rotated successfully.');
    }

    public function flip()
    {
        $this->validate([
            'direction' => 'required|in:horizontal,vertical',
        ]);

        $img = InterventionImage::make(Storage::disk('public')->path($this->path));
        $img->flip($this->direction);
        $img->save();

        session()->flash('message', 'Image flipped successfully.');
    }

    public function grayscale()
    {
        $img = InterventionImage::make(Storage::disk('public')->path($this->path));
        $img->greyscale();
        $img->save();

        session()->flash('message', 'Image converted to grayscale successfully.');
    }

    public function render()
    {
        return view('livewire.image-upload');
    }
}
