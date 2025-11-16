<?php

use App\Livewire\ProfileImageUpload;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    Storage::fake('public');
});

it('can render the profile image upload component', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ProfileImageUpload::class)
        ->assertSuccessful();
});

it('validates image is required', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ProfileImageUpload::class)
        ->call('save')
        ->assertHasErrors(['image' => 'required']);
});

it('validates file must be an image', function () {
    $user = User::factory()->create();
    $file = UploadedFile::fake()->create('document.pdf', 100);

    Livewire::actingAs($user)
        ->test(ProfileImageUpload::class)
        ->set('image', $file)
        ->call('save')
        ->assertHasErrors(['image' => 'image']);
});

it('can upload a profile image', function () {
    $user = User::factory()->create();
    $file = UploadedFile::fake()->image('profile.jpg');

    Livewire::actingAs($user)
        ->test(ProfileImageUpload::class)
        ->set('image', $file)
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('profile-image-uploaded');

    Storage::disk('public')->assertExists('profile_image.jpg');
});

it('replaces existing profile image when uploading new one', function () {
    $user = User::factory()->create();

    // Upload first image
    $firstImage = UploadedFile::fake()->image('first.jpg');
    Livewire::actingAs($user)
        ->test(ProfileImageUpload::class)
        ->set('image', $firstImage)
        ->call('save');

    Storage::disk('public')->assertExists('profile_image.jpg');

    // Upload second image
    $secondImage = UploadedFile::fake()->image('second.jpg');
    Livewire::actingAs($user)
        ->test(ProfileImageUpload::class)
        ->set('image', $secondImage)
        ->call('save')
        ->assertHasNoErrors();

    // Should still have only one file with the fixed name
    Storage::disk('public')->assertExists('profile_image.jpg');
});

it('resets image property after successful upload', function () {
    $user = User::factory()->create();
    $file = UploadedFile::fake()->image('profile.jpg');

    Livewire::actingAs($user)
        ->test(ProfileImageUpload::class)
        ->set('image', $file)
        ->call('save')
        ->assertSet('image', null);
});
