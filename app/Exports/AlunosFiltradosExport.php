<?php

namespace App\Exports;

use App\Models\Aluno;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AlunosFiltradosExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings
{

    //Recebe os dados do controler (uuid)
    public function __construct(array $array)
    {
        $this->array = $array;
        return $this;
    }


    //A consulta no Banco é feita Aqui.
    public function collection()
    {
        $id[] = "";
        foreach ($this->array as $turma) {

            $posionId = explode('/', $turma);
            $pivot_id = $posionId[2];

            array_push($id, $pivot_id);
        }
        array_shift($id);

        $alunos_02 = DB::table('aluno_turma')->whereIn('aluno_turma.id', $id)
            ->join('alunos', 'aluno_turma.aluno_id', '=', 'alunos.id')
            ->join('turmas', 'aluno_turma.turma_id', '=', 'turmas.id')
            ->join('classificacaos', 'aluno_turma.classificacao_id', '=', 'classificacaos.id')
            ->select(
                'alunos.INEP',
                'alunos.NOME',
                'alunos.NASCIMENTO',
                'alunos.CERTIDAO_CIVIL',
                'alunos.MODELO_CERTIDAO',
                'alunos.MATRICULA_CERTIDAO',
                'alunos.DADOS_CERTIDAO',
                'alunos.EXPEDICAO_CERTIDAO',
                'alunos.NUMERO_RG',
                'alunos.UF_RG',
                'alunos.ORGAO_EXPEDIDOR_RG',
                'alunos.EXPEDICAO_RG',
                'alunos.CPF',
                'alunos.NATURALIDADE',
                'alunos.ESTADO',
                'alunos.NACIONALIDADE',
                'alunos.SEXO',
                'alunos.NIS',
                'alunos.BOLSA_FAMILIA',
                'alunos.SUS',
                'alunos.NECESSIDADES_ESPECIAIS',
                'alunos.NECESSIDADES_ESPECIAIS_DESCRICACAO',
                'alunos.NECESSIDADES_ESPECIAIS_CODIGO',
                'alunos.COR',
                'alunos.FONE',
                'alunos.FONE_II',
                'alunos.EMAIL',
                'alunos.MAE',
                'alunos.PROF_MAE',
                'alunos.PAI',
                'alunos.PROF_PAI',
                'alunos.ENDERECO',
                'alunos.URBANO',
                'alunos.CIDADE',
                'alunos.CIDADE_ESTADO',
                'alunos.TRANSPORTE',
                'alunos.PONTO_ONIBUS',
                'alunos.MOTORISTA',
                'alunos.MOTORISTA_II',
                'alunos.OBSERVACOES',

                'turma_id',
                'turmas.TURMA',
                'turmas.TURNO',
                'turmas.ANO',
                'turmas.UNICO',

                'classificacaos.STATUS'
            )
            ->orderBy('aluno_turma.turma_id', 'ASC')->orderBy('alunos.NOME', 'ASC')
            ->get();
        //    foreach ($alunos_02 as $value) {
        //        foreach ($value as $key_02 => $value_02) {
        //            $html[$key_02] = $value_02;
        //        }////
        //       echo $html['NOME']. " - ".$html['TURMA'];
        //       echo "<br>";
        //    }

        return $alunos_02;
    }

    public function map($alunos_02): array
    {
        return [
            $alunos_02->TURMA,
            $alunos_02->TURNO,
            \Carbon\Carbon::parse($alunos_02->ANO)->format('Y'),
            $alunos_02->UNICO,
            $alunos_02->STATUS,
            $alunos_02->INEP,
            $alunos_02->NOME,
            \Carbon\Carbon::parse($alunos_02->NASCIMENTO)->format('d-m-Y'),
            $alunos_02->CERTIDAO_CIVIL,
            $alunos_02->MODELO_CERTIDAO,
            $alunos_02->MATRICULA_CERTIDAO,
            $alunos_02->DADOS_CERTIDAO,
            \Carbon\Carbon::parse($alunos_02->EXPEDICAO_CERTIDAO)->format('d-m-Y'),
            $alunos_02->NUMERO_RG,
            $alunos_02->UF_RG,
            $alunos_02->ORGAO_EXPEDIDOR_RG,
            \Carbon\Carbon::parse($alunos_02->EXPEDICAO_RG)->format('d-m-Y'),
            $alunos_02->CPF,
            $alunos_02->NATURALIDADE,
            $alunos_02->ESTADO,
            $alunos_02->NACIONALIDADE,
            $alunos_02->SEXO,
            $alunos_02->NIS,
            $alunos_02->BOLSA_FAMILIA,
            $alunos_02->SUS,
            $alunos_02->NECESSIDADES_ESPECIAIS,
            $alunos_02->NECESSIDADES_ESPECIAIS_DESCRICACAO,
            $alunos_02->NECESSIDADES_ESPECIAIS_CODIGO,
            $alunos_02->COR,
            $alunos_02->FONE,
            $alunos_02->FONE_II,
            $alunos_02->EMAIL,
            $alunos_02->MAE,
            $alunos_02->PROF_MAE,
            $alunos_02->PAI,
            $alunos_02->PROF_PAI,
            $alunos_02->ENDERECO,
            $alunos_02->URBANO,
            $alunos_02->CIDADE,
            $alunos_02->CIDADE_ESTADO,
            $alunos_02->TRANSPORTE,
            $alunos_02->PONTO_ONIBUS,
            $alunos_02->MOTORISTA,
            $alunos_02->MOTORISTA_II,
            $alunos_02->OBSERVACOES,

        ];
    }
    //Cabeçalho da tabela
    public function headings(): array
    {
        //return (array) $this->menu;
        return
            [
                'TURMA', 'TURNO', 'ANO', 'UNICO', 'STATUS', 'INEP', 'NOME', 'NASCIMENTO', 'CERTIDAO_CIVIL', 'MODELO_CERTIDAO', 'MATRICULA_CERTIDAO', 'DADOS_CERTIDAO',
                'EXPEDICAO_CERTIDAO', 'NUMERO_RG', 'UF_RG', 'ORGAO_EXPEDIDOR_RG', 'EXPEDICAO_RG', 'CPF', 'NATURALIDADE', 'ESTADO',
                'NACIONALIDADE', 'SEXO', 'NIS', 'BOLSA_FAMILIA', 'SUS', 'NECESSIDADES_ESPECIAIS', 'NECESSIDADES_ESPECIAIS_DESCRICACAO',
                'NECESSIDADES_ESPECIAIS_CODIGO', 'COR', 'FONE', 'FONE_II', 'EMAIL', 'MAE', 'PROF_MAE', 'PAI', 'PROF_PAI', 'ENDERECO',
                'URBANO', 'CIDADE', 'CIDADE_ESTADO', 'TRANSPORTE', 'PONTO_ONIBUS', 'MOTORISTA', 'MOTORISTA_II', 'OBSERVACOES'
            ];
    }
    //
    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class    => function (AfterSheet $event) {
    //             $cellRange = 'A1:W1'; // All headers
    //             $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
    //         },
    //     ];
    // }
    //
}
