<?php

use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shift::create(['TURNO' => 'MATUTINO']);
        Shift::create(['TURNO' => 'MATUTINO/VESPERTINO']);
        Shift::create(['TURNO' => 'MATUTINO/NOTURNO']);
        Shift::create(['TURNO' => 'MATUTINO/VESPERTINO/NOTURNO']);
        Shift::create(['TURNO' => 'VESPERTINO']);
        Shift::create(['TURNO' => 'VESPERTINO/NOTURNO']);
        Shift::create(['TURNO' => 'NOTURNO']);

    }
}
