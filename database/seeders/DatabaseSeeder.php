<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database. Safe to run more than once.
     */
    public function run(): void
    {
        // your own admin account, set ADMIN_EMAIL and ADMIN_PASSWORD in .env before seeding
        if (env('ADMIN_EMAIL') && env('ADMIN_PASSWORD')) {
            User::updateOrCreate(
                ['email' => env('ADMIN_EMAIL')],
                [
                    'name' => env('ADMIN_NAME', 'Administrator'),
                    'password' => Hash::make(env('ADMIN_PASSWORD')),
                    'role' => User::ROLE_ADMIN,
                ]
            );
        }

        // shared demo accounts, visitors sign in with the demo buttons so the passwords stay random
        $demoAdmin = $this->user('Demo Admin', config('demo.accounts.admin'), User::ROLE_ADMIN);
        $demoClient = $this->user('Juan Dela Cruz', config('demo.accounts.client'), User::ROLE_CLIENT);
        $maria = $this->user('Maria Santos', 'maria.santos@example.com', User::ROLE_CLIENT);
        $paolo = $this->user('Paolo Reyes', 'paolo.reyes@example.com', User::ROLE_CLIENT);

        $vehicles = [
            // plate, brand, model, year, type, owner, month added
            ['NAB-4821', 'Toyota', 'Hilux', 2022, 'Truck', $demoClient, 1],
            ['DAE-1093', 'Isuzu', 'Traviz', 2021, 'Van', $demoClient, 2],
            ['PQR-7730', 'Mitsubishi', 'Montero Sport', 2023, 'SUV', $demoClient, 4],
            ['KTY-2045', 'Toyota', 'Vios', 2020, 'Sedan', $demoClient, 6],
            ['MCY-8812', 'Honda', 'XRM 125', 2024, 'Motorcycle', $demoClient, 8],
            ['FLD-3307', 'Isuzu', 'N-Series Dump', 2019, 'Truck', $maria, 1],
            ['HYD-5521', 'Hyundai', 'Staria', 2023, 'Van', $maria, 3],
            ['RSQ-9014', 'Ford', 'Ranger Raptor', 2024, 'Truck', $maria, 5],
            ['NVP-6650', 'Nissan', 'Navara', 2022, 'Truck', $paolo, 3],
            ['SZK-1188', 'Suzuki', 'Jimny', 2023, 'SUV', $paolo, 7],
            ['YMH-4430', 'Yamaha', 'Aerox', 2024, 'Motorcycle', $paolo, 9],
            ['ADM-0001', 'Toyota', 'Land Cruiser', 2021, 'SUV', $demoAdmin, 2],
        ];

        foreach ($vehicles as [$plate, $brand, $model, $year, $type, $owner, $month]) {
            $vehicle = Vehicle::firstOrNew(['plate' => $plate]);

            if ($vehicle->exists) {
                continue;
            }

            // spread the records across this year so the dashboard charts have something to show
            $addedOn = now()->startOfYear()->addMonths($month - 1)->addDays(rand(0, 25));

            $vehicle->forceFill([
                'brand' => $brand,
                'model' => $model,
                'year' => $year,
                'type' => $type,
                'user_id' => $owner->id,
                'created_at' => $addedOn->isFuture() ? now() : $addedOn,
            ])->save();
        }
    }

    private function user(string $name, string $email, string $role): User
    {
        return User::firstOrCreate(
            ['email' => $email],
            ['name' => $name, 'password' => Hash::make(Str::random(32)), 'role' => $role]
        );
    }
}
