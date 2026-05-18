<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       //truncate tables to avoid duplicates
        DB::table('users')->truncate();
        DB::table('job_listings')->truncate();

        //call seeders
        $this->call(RandomUserSeeder::class);
        $this->call(JobSeeder::class);
      
    }
}
