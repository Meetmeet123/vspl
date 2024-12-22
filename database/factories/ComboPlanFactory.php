<?php

namespace Database\Factories;

use App\Models\ComboPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComboPlanFactory extends Factory
{
    protected $model = ComboPlan::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word . ' Combo Plan',
            'price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
