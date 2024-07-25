<title>Photo Share Platform</title>
<div>
    <!-- Upload Form -->
    <form wire:submit.prevent="upload">
        <input type="file" wire:model="image">
        @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
        <button type="submit">Upload Image</button>
    </form>

    <!-- Display Uploaded Image -->
    @if (isset($path))
        <div class="mt-4">
            <img src="{{ Storage::url($path) }}" alt="Uploaded Image" class="my-4">
        </div>

        <!-- Resize Form -->
        <form wire:submit.prevent="resize">
            <input type="number" wire:model="width" placeholder="Width">
            <input type="number" wire:model="height" placeholder="Height">
            <button type="submit">Resize</button>
        </form>

        <!-- Crop Form -->
        <form wire:submit.prevent="crop">
            <input type="number" wire:model="x" placeholder="X">
            <input type="number" wire:model="y" placeholder="Y">
            <input type="number" wire:model="width" placeholder="Width">
            <input type="number" wire:model="height" placeholder="Height">
            <button type="submit">Crop</button>
        </form>

        <!-- Rotate Form -->
        <form wire:submit.prevent="rotate">
            <input type="number" wire:model="angle" placeholder="Angle">
            <button type="submit">Rotate</button>
        </form>

        <!-- Flip Form -->
        <form wire:submit.prevent="flip">
            <select wire:model="direction">
                <option value="horizontal">Horizontal</option>
                <option value="vertical">Vertical</option>
            </select>
            <button type="submit">Flip</button>
        </form>

        <!-- Grayscale Form -->
        <form wire:submit.prevent="grayscale">
            <button type="submit">Grayscale</button>
        </form>
    @endif

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>
