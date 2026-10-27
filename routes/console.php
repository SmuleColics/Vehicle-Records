<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// for forgotten passwords: php artisan user:reset-password you@example.com --admin
Artisan::command('user:reset-password {email} {--admin : Also give the account admin access}', function (string $email) {
    $user = User::where('email', $email)->first();

    if (!$user) {
        $this->error("No account found for $email");
        return 1;
    }

    $password = Str::password(12, symbols: false);
    $user->password = Hash::make($password);

    if ($this->option('admin')) {
        $user->role = User::ROLE_ADMIN;
    }

    $user->save();

    $this->info("New password for {$user->email} ({$user->role}): $password");
    $this->comment('Log in and change it from the Profile page.');
})->purpose('Set a new random password for an account');
