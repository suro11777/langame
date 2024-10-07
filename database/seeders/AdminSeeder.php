<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@admin.com')->first();

        if (! $admin) {
            $admin = User::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
            ]);

        }

        if (! Role::where('name', 'admin')->first()) {
            Role::create(['name' => 'admin']);
        }
        $admin->assignRole('admin');
    }
}
