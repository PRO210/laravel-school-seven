<?php

use App\Models\Solicitacao;
use Illuminate\Database\Seeder;

class SolicitacaosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Solicitacao::create(['NOME' => 'TRANSFERÊNCIA', 'TIPO' => 'ACADÊMICA']);
    }
}
