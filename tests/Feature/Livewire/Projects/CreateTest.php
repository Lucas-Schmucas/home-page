<?php

use App\Livewire\Projects\Create;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

it('redirects guests to login when trying to access create project page', function () {
    $this->get(route('projects.create'))
        ->assertRedirect(route('login'));
});

it('allows authenticated users to access create project page', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('projects.create'))
        ->assertSuccessful();
});

it('can render the create project component', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->assertSuccessful();
});

it('validates required fields', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->call('save')
        ->assertHasErrors([
            'name' => 'required',
            'description' => 'required',
        ]);
});

it('validates name max length', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('name', str_repeat('a', 256))
        ->call('save')
        ->assertHasErrors(['name' => 'max']);
});

it('validates url format', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('url', 'not-a-valid-url')
        ->call('save')
        ->assertHasErrors(['url' => 'url']);
});

it('validates github_url format', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('github_url', 'not-a-valid-url')
        ->call('save')
        ->assertHasErrors(['github_url' => 'url']);
});

it('can create a project with minimum required fields', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('name', 'Awesome Project')
        ->set('description', 'This is an awesome project for testing.')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('projects'));

    assertDatabaseHas('projects', [
        'name' => 'Awesome Project',
        'description' => 'This is an awesome project for testing.',
        'url' => null,
        'github_url' => null,
    ]);
});

it('can create a project with all fields', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('name', 'Complete Project')
        ->set('description', 'A comprehensive project with all details.')
        ->set('url', 'https://example.com/project')
        ->set('github_url', 'https://github.com/user/repo')
        ->set('technologies', ['Laravel', 'Vue.js', 'Tailwind CSS'])
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('projects'));

    $project = Project::where('name', 'Complete Project')->first();

    expect($project)->not->toBeNull();
    expect($project->name)->toBe('Complete Project');
    expect($project->description)->toBe('A comprehensive project with all details.');
    expect($project->url)->toBe('https://example.com/project');
    expect($project->github_url)->toBe('https://github.com/user/repo');
    expect($project->technologies)->toBe(['Laravel', 'Vue.js', 'Tailwind CSS']);
});

it('can add technology fields dynamically', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->assertSet('technologies', [''])
        ->call('addTechnology')
        ->assertSet('technologies', ['', ''])
        ->call('addTechnology')
        ->assertSet('technologies', ['', '', '']);
});

it('can remove technology fields', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('technologies', ['Laravel', 'Vue.js', 'Tailwind CSS'])
        ->call('removeTechnology', 1)
        ->assertSet('technologies', ['Laravel', 'Tailwind CSS']);
});

it('filters out empty technologies when saving', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('name', 'Filter Test Project')
        ->set('description', 'Testing technology filtering')
        ->set('technologies', ['Laravel', '', 'Vue.js', '   ', 'Tailwind CSS'])
        ->call('save')
        ->assertHasNoErrors();

    $project = Project::where('name', 'Filter Test Project')->first();

    expect($project->technologies)->toHaveCount(3);
    expect($project->technologies)->toContain('Laravel');
    expect($project->technologies)->toContain('Vue.js');
    expect($project->technologies)->toContain('Tailwind CSS');
});

it('can create a project with empty technologies array', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('name', 'No Tech Project')
        ->set('description', 'A project with no technologies')
        ->set('technologies', [''])
        ->call('save')
        ->assertHasNoErrors();

    $project = Project::where('name', 'No Tech Project')->first();

    expect($project->technologies)->toBe([]);
});

it('sets success flash message after creation', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('name', 'Flash Test Project')
        ->set('description', 'Testing flash message')
        ->call('save')
        ->assertSessionHas('success', 'Project added successfully!');
});

it('prevents unauthenticated users from creating projects via direct component access', function () {
    $this->get(route('projects.create'))
        ->assertRedirect(route('login'));

    expect(Project::count())->toBe(0);
});
