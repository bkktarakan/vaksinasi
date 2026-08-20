<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Kantor Induk',
            'username' => 'induk',
            'wilker' => 'Kantor Induk',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Wilker Nunukan',
            'username' => 'nunukan',
            'wilker' => 'Wilker Nunukan',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Wilker Tanjung Selor',
            'username' => 'tanjung_selor',
            'wilker' => 'Wilker Tanjung Selor',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Wilker Berau',
            'username' => 'berau',
            'wilker' => 'Wilker Berau',
            'password' => bcrypt('password'),
        ]);
    }
}
