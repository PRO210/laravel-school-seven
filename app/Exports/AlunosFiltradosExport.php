<?php

namespace App\Exports;

use App\Models\Aluno;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlunosFiltradosExport implements FromCollection, WithMapping
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
            ->select(
                'aluno_turma.id',
                'aluno_id',
                'alunos.NOME',
                'aluno_turma.OUVINTE',
                'alunos.NECESSIDADES_ESPECIAIS',
                'turma_id',
                'turmas.TURMA',
                'turmas.TURNO',
                'turmas.ANO',
                'turmas.UNICO'
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
            $alunos_02->NOME,
            $alunos_02->TURMA,
            $alunos_02->TURNO


        ];
    }
}
