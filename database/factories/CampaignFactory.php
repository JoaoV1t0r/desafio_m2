<?php

namespace Database\Factories;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Campaign::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle(),
            'discount' => $this->faker->randomFloat(2,0, 20)
        ];
    }
}
