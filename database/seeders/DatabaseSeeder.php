<?php

namespace Database\Seeders;

use App\Models\ProductCampaign;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ProductCampaign::factory()->create();
    }
}
