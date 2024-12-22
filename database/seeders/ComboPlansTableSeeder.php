<?php

namespace Database\Seeders;

use App\Models\ComboPlan;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class ComboPlansTableSeeder extends Seeder
{
    public function run()
    {
        $totalComboPlans = 15000;
        $chunkSize = 500;
        $planIds = Plan::pluck('id')->toArray();

        for ($i = 0; $i < $totalComboPlans / $chunkSize; $i++) {
            ComboPlan::factory($chunkSize)->create()->each(function ($comboPlan) use ($planIds) {
                $randomPlans = array_rand(array_flip($planIds), rand(2, 5));
                $comboPlan->plans()->attach($randomPlans);
            });
        }
    }
}
