<?php

namespace Database\Seeders;

use App\Models\OwnerGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OwnerGroup::create(['name' => 'المجموعة الرئيسية']);

    }
}
