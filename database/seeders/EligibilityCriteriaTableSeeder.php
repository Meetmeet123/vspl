<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EligibilityCriteriaTableSeeder extends Seeder
{
    public function run()
    {
        $criteria = [];

        for ($i = 1; $i <= 15000; $i++) {
            $criteria[] = [
                'name' => 'Eligibility Criteria ' . $i,
                'age_less_than' => rand(18, 60),
                'age_greater_than' => rand(10, 18),
                'last_login_days_ago' => now()->subDays(rand(1, 365)),
                'income_less_than' => rand(100000, 200000),
                'income_greater_than' => rand(20000, 99999),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $chunks = array_chunk($criteria, 500);
        foreach ($chunks as $chunk) {
            DB::table('eligibility_criterias')->insert($chunk);
        }
    }
}
