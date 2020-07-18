<?php

use App\Models\Documento;
use Illuminate\Database\Seeder;

class DocumentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Documento::create(['NAME' => 'RG']);
        Documento::create(['NAME' => 'CPF']);
        Documento::create(['NAME' => 'NIS']);
        Documento::create(['NAME' => 'SUS']);
        Documento::create(['NAME' => 'CERTIDÃO NASCIMENTO']);
        Documento::create(['NAME' => 'CERTIDÃO CASAMENTO']);
    }
}
