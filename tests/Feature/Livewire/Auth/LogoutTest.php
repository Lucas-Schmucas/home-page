<?php

use App\Livewire\Auth\Logout;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertGuest;

uses(RefreshDatabase::class);

it('can render the logout component', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Logout::class)
        ->assertSuccessful();
});

it('logs out authenticated user when logout is called', function () {
    $user = User::factory()->create();

    actingAs($user);

    expect(auth()->check())->toBeTrue();

    Livewire::test(Logout::class)
        ->call('logout')
        ->assertRedirect(route('home'));

    assertGuest();
});

it('invalidates session when logging out', function () {
    $user = User::factory()->create();

    actingAs($user);

    $sessionId = session()->getId();

    Livewire::test(Logout::class)
        ->call('logout');

    expect(session()->getId())->not->toBe($sessionId);
});

it('shows logout button only when authenticated', function () {
    $response = $this->get(route('home'));

    $response->assertDontSee('Logout');

    $user = User::factory()->create();

    actingAs($user)
        ->get(route('home'))
        ->assertSee('Logout');
});

it('redirects to home with success message after logout', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Logout::class)
        ->call('logout')
        ->assertRedirect(route('home'));
});
