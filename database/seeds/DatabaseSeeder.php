<?php

use Blit\StatesAndCities\Seeds\CitiesTableSeeder;
use Blit\StatesAndCities\Seeds\CountriesTableSeeder;
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
        $this->call([
            PlansTableSeeder::class,
            TenantsTableSeeder::class,
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            DocumentosTableSeeder::class,
            ShiftsTableSeeder::class,
            TurmaTableSeeder::class,
            SolicitacaosTableSeeder::class,
            LogTableSeeder::class,
        ]);
    }
}
