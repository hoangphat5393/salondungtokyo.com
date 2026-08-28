<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Service;
use App\Models\Work;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Album::factory(2)
        //     // ->count(2) // Sinh 10 album
        //     ->hasItems(3) // Mỗi album có 5 item
        //     ->create();

        // Work::factory(4) // Tạo 3 work
        //     ->create();
        Service::factory(6)->create();
    }
}
