<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlansTableSeeder extends Seeder
{
    public function run()
    {
        $totalRecords = 50000;
        $chunkSize = 1000;

        // Generate the records in chunks
        for ($i = 0; $i < $totalRecords / $chunkSize; $i++) {
            Plan::factory()->count($chunkSize)->create();
        }
    }
}


