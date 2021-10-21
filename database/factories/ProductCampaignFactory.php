<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\City;
use App\Models\Group;
use App\Models\Product;
use App\Models\ProductCampaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCampaignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductCampaign::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'campaign_id' => Campaign::factory()->has(Group::factory()->has(City::factory()->count(5))->count(3))
        ];
    }
}
