<?php

use App\Models\Turma;
use Illuminate\Database\Seeder;

class TurmaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Turma::create(['TURMA' => '1 ANO','CATEGORIA' => 'EDUCAÇÃO INFANTIL','TURMA_EXTRA' => 'NAO','TURNO' => 'MATUTINO',
        'UNICO' => 'A','ANO' => '2020-02-01','TURMA_IDADE_MINIMA' => '6',]);

        Turma::create(['TURMA' => '2 ANO','CATEGORIA' => '1° GRAU','TURMA_EXTRA' => 'NAO','TURNO' => 'MATUTINO',
        'UNICO' => 'B','ANO' => '2020-02-01','TURMA_IDADE_MINIMA' => '7',]);

        Turma::create(['TURMA' => '3 ANO','CATEGORIA' => '1° GRAU','TURMA_EXTRA' => 'NAO','TURNO' => 'VESPERTINO',
        'UNICO' => 'C','ANO' => '2020-02-01','TURMA_IDADE_MINIMA' => '8',]);

        Turma::create(['TURMA' => '4 ANO','CATEGORIA' => '1° GRAU','TURMA_EXTRA' => 'NAO','TURNO' => 'VESPERTINO',
        'UNICO' => 'D','ANO' => '2020-02-01','TURMA_IDADE_MINIMA' => '9',]);

    }
}
