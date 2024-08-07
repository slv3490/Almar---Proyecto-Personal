<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            "name" => "admin",
            "email" => "admin@admin.com",
            "last_name" => "admin",
            "password" => Hash::make("123123")
        ]);

        $admin->assignRole("admin");

        $editor = User::create([
            "name" => "editor",
            "email" => "editor@editor.com",
            "last_name" => "editor",
            "password" => Hash::make("editor")
        ]);

        $editor->assignRole("editor");

        $spectator = User::create([
            "name" => "espectador",
            "email" => "espectador@espectador.com",
            "last_name" => "espectador",
            "password" => Hash::make("espectador")
        ]);

        $spectator->assignRole("spectator");
    }
}
