<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['CATEGORIA' => 'EDUCAÇÃO INFANTIL']);
        Category::create(['CATEGORIA' => '1º GRAU']);
        Category::create(['CATEGORIA' => 'FASE']);
    }
}
