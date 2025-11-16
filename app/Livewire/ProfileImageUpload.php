<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ProfileImageUpload extends Component
{
    use WithFileUploads;

    #[Validate('required|image|max:2048')]
    public ?TemporaryUploadedFile $image = null;

    public function save(): void
    {
        try {
            $this->validate();

            $profileImagePath = 'profile_image.jpg';

            // Delete the old image if it exists
            if (Storage::disk('public')->exists($profileImagePath)) {
                Storage::disk('public')->delete($profileImagePath);
            }

            // Save the new image with a fixed name
            $this->image->storeAs('', $profileImagePath, 'public');

            session()->flash('success', 'Profile image uploaded successfully!');

            $this->dispatch('profile-image-uploaded');
            $this->reset('image');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            $this->addError('image', 'Failed to upload image. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.profile-image-upload');
    }
}
