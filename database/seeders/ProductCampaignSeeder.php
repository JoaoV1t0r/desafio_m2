<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCampaign;
use Illuminate\Database\Seeder;

class ProductCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCampaign::factory()->create();
    }
}
