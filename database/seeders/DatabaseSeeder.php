<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(AdminUserSeeder::class);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
                'password' => Hash::make('password'),
            'email' => 'test1@example.com',
        ]);
    }
}
