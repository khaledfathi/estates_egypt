<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->createAdminUser();
        $this->callSeeders();
    }
    private function createAdminUser()
    {
        User::create([
            "name" => "admin",
            "email" => "admin@admin.com",
            "password" => Hash::make("admin"),
            "is_admin" => true
        ]);
    }
    private function callSeeders()
    {
        // call another seeders 
    }
}
