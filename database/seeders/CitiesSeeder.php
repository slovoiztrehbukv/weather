<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $path = __DIR__ . '/Raw/cities.sql';
            \Illuminate\Support\Facades\DB::unprepared(file_get_contents($path));
        } catch (\Throwable $e) {
            $this->command->warn($e->getMessage());

        }

        $this->command->info('Cities table seeded');
    }
}
