<?php

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
        $this->call(UserSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(DocumentosTableSeeder::class);
        $this->call(ShiftsTableSeeder::class);
        $this->call(TurmaTableSeeder::class);
        $this->call(SolicitacaosTableSeeder::class);
    }
}
