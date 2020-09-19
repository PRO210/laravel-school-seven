<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'FREE',
            'url' => 'f-r-e-e',
            'price' => 0.00,
            'description' => 'Plano Convencional',
        ]);
    }
}
