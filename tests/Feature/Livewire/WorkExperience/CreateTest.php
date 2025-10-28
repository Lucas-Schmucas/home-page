<?php

use App\Livewire\WorkExperience\Create;
use App\Models\User;
use App\Models\WorkExperience;
use App\Technology;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

beforeEach(function () {
    Storage::fake('public');
    Cache::flush();
});

it('redirects guests to login when trying to access create work experience page', function () {
    $this->get(route('work-experience.create'))
        ->assertRedirect(route('login'));
});

it('allows authenticated users to access create work experience page', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('work-experience.create'))
        ->assertSuccessful();
});

it('can render the create work experience component', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->assertSuccessful();
});

it('passes available technologies to the view', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->assertViewHas('availableTechnologies', Technology::cases());
});

it('validates required fields', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->call('save')
        ->assertHasErrors([
            'job_title' => 'required',
            'company_name' => 'required',
            'description' => 'required',
            'start_date' => 'required',
        ]);
});

it('validates job_title max length', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('job_title', str_repeat('a', 256))
        ->call('save')
        ->assertHasErrors(['job_title' => 'max']);
});

it('validates company_name max length', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('company_name', str_repeat('a', 256))
        ->call('save')
        ->assertHasErrors(['company_name' => 'max']);
});

it('validates color max length', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('color', str_repeat('a', 256))
        ->call('save')
        ->assertHasErrors(['color' => 'max']);
});

it('validates start_date format', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('start_date', 'not-a-date')
        ->call('save')
        ->assertHasErrors(['start_date' => 'date']);
});

it('validates end_date format', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('end_date', 'not-a-date')
        ->call('save')
        ->assertHasErrors(['end_date' => 'date']);
});

it('can create work experience with minimum required fields', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('job_title', 'Senior Developer')
        ->set('company_name', 'Tech Corp')
        ->set('description', 'Led development of amazing features.')
        ->set('start_date', '2023-01-01')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('about'));

    assertDatabaseHas('work_experiences', [
        'job_title' => 'Senior Developer',
        'company_name' => 'Tech Corp',
        'description' => 'Led development of amazing features.',
        'image' => null,
        'color' => null,
        'end_date' => null,
    ]);
});

it('can create work experience with all fields', function () {
    $user = User::factory()->create();
    $image = UploadedFile::fake()->image('company-logo.jpg');

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('job_title', 'Lead Engineer')
        ->set('company_name', 'Awesome Inc')
        ->set('description', 'Built amazing products with great team.')
        ->set('image', $image)
        ->set('color', 'blue')
        ->set('start_date', '2022-01-01')
        ->set('end_date', '2023-12-31')
        ->set('technologies', [Technology::Laravel->value, Technology::Vue->value])
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('about'));

    $workExperience = WorkExperience::where('job_title', 'Lead Engineer')->first();

    expect($workExperience)->not->toBeNull();
    expect($workExperience->job_title)->toBe('Lead Engineer');
    expect($workExperience->company_name)->toBe('Awesome Inc');
    expect($workExperience->description)->toBe('Built amazing products with great team.');
    expect($workExperience->image)->not->toBeNull();
    expect($workExperience->color)->toBe('blue');
    expect($workExperience->start_date->format('Y-m-d'))->toBe('2022-01-01');
    expect($workExperience->end_date->format('Y-m-d'))->toBe('2023-12-31');
    expect($workExperience->technologies->count())->toBe(2);
    expect($workExperience->technologies->pluck('value')->toArray())->toBe([
        Technology::Laravel->value,
        Technology::Vue->value,
    ]);

    Storage::disk('public')->assertExists($workExperience->image);
});

it('stores image in correct directory', function () {
    $user = User::factory()->create();
    $image = UploadedFile::fake()->image('logo.jpg');

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('job_title', 'Developer')
        ->set('company_name', 'Test Company')
        ->set('description', 'Test description')
        ->set('start_date', '2023-01-01')
        ->set('image', $image)
        ->call('save');

    $workExperience = WorkExperience::where('job_title', 'Developer')->first();

    expect($workExperience->image)->toStartWith('work-experience/');
    Storage::disk('public')->assertExists($workExperience->image);
});

it('can create work experience without end_date for current position', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('job_title', 'Current Developer')
        ->set('company_name', 'Current Company')
        ->set('description', 'Currently working here.')
        ->set('start_date', '2023-01-01')
        ->set('end_date', null)
        ->call('save')
        ->assertHasNoErrors();

    $workExperience = WorkExperience::where('job_title', 'Current Developer')->first();

    expect($workExperience->end_date)->toBeNull();
});

it('converts technology values to enum collection', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('job_title', 'Tech Lead')
        ->set('company_name', 'Tech Company')
        ->set('description', 'Leading tech initiatives.')
        ->set('start_date', '2023-01-01')
        ->set('technologies', [
            Technology::Php->value,
            Technology::Laravel->value,
            Technology::Mysql->value,
        ])
        ->call('save')
        ->assertHasNoErrors();

    $workExperience = WorkExperience::where('job_title', 'Tech Lead')->first();

    expect($workExperience->technologies->count())->toBe(3);
    expect($workExperience->technologies->first())->toBeInstanceOf(Technology::class);
    expect($workExperience->technologies->first())->toBe(Technology::Php);
});

it('can create work experience with empty technologies', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('job_title', 'Manager')
        ->set('company_name', 'Management Corp')
        ->set('description', 'Managing teams.')
        ->set('start_date', '2023-01-01')
        ->set('technologies', [])
        ->call('save')
        ->assertHasNoErrors();

    $workExperience = WorkExperience::where('job_title', 'Manager')->first();

    expect($workExperience->technologies->count())->toBe(0);
});

it('clears work experience cache after creation', function () {
    $user = User::factory()->create();

    Cache::shouldReceive('forget')
        ->once()
        ->with('work_experience');

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('job_title', 'Cache Test')
        ->set('company_name', 'Cache Company')
        ->set('description', 'Testing cache clearing')
        ->set('start_date', '2023-01-01')
        ->call('save');
});

it('sets success flash message after creation', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('job_title', 'Flash Test')
        ->set('company_name', 'Flash Company')
        ->set('description', 'Testing flash message')
        ->set('start_date', '2023-01-01')
        ->call('save')
        ->assertSessionHas('success', 'Work experience added successfully!');
});

it('prevents unauthenticated users from creating work experience via direct component access', function () {
    $this->get(route('work-experience.create'))
        ->assertRedirect(route('login'));

    expect(WorkExperience::count())->toBe(0);
});
