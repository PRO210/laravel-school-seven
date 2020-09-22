<?php

use App\Models\Log;
use Illuminate\Database\Seeder;

class LogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::create(['TIPO' => 'INSERIR']);
        Log::create(['TIPO' => 'EDITAR']);
        Log::create(['TIPO' => 'DELETAR']);
    }
}
