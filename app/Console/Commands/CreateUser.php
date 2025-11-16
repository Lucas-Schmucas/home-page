<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user';

    /*@*
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->ask('Email address');
        $password = $this->secret('Password');

        $confirm = $this->secret('Confirm password');

        if ($password !== $confirm) {
            $this->error('Passwords do not match!');

            return self::FAILURE;
        }

        if (User::query()->where('email', $email)->exists()) {
            $this->error('A user with that email already exists.');

            return self::FAILURE;
        }

        $user = User::query()->create([
            'name' => 'Lucas',
            'surname' => 'Schmucas',
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $this->info("Verified user created: {$user->email}");

        return self::SUCCESS;
    }
}
