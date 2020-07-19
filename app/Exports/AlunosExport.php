<?php

namespace App\Exports;

use App\Models\Aluno;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlunosExport implements FromQuery, ShouldAutoSize, WithHeadings
{

    use Exportable;


    //Recebe os dados do controler (uuid)
    public function __construct(array $array)
    {
        $this->array = $array;

        return $this;
    }

    //A consulta no Banco é feita Aqui.
    public function query()
    {
        return Aluno::query()->whereIn('uuid', $this->array);
    }

    //Cabeçalho da tabela
    public function headings(): array
    {
        //return (array) $this->menu;
        return
            [
                'id','uuid','INEP', 'PRIMEIRO_NOME','NOME', 'NASCIMENTO', 'CERTIDAO_CIVIL', 'MODELO_CERTIDAO', 'MATRICULA_CERTIDAO', 'DADOS_CERTIDAO',
                'EXPEDICAO_CERTIDAO', 'NUMERO_RG', 'UF_RG','ORGAO_EXPEDIDOR_RG', 'EXPEDICAO_RG', 'CPF', 'NATURALIDADE', 'ESTADO',
                'NACIONALIDADE', 'SEXO', 'NIS', 'BOLSA_FAMILIA', 'SUS', 'NECESSIDADES_ESPECIAIS', 'NECESSIDADES_ESPECIAIS_DESCRICACAO',
                'NECESSIDADES_ESPECIAIS_CODIGO', 'COR', 'FONE', 'FONE_II', 'EMAIL', 'MAE', 'PROF_MAE', 'PAI', 'PROF_PAI', 'ENDERECO',
                'URBANO', 'CIDADE', 'CIDADE_ESTADO', 'TRANSPORTE', 'PONTO_ONIBUS', 'MOTORISTA', 'MOTORISTA_II', 'OBSERVACOES', 'EXCLUIDO',
                'EXCLUIDO_PASTA', 'ATUALIZACAO','created_at','updated_at'
            ];
    }
}
