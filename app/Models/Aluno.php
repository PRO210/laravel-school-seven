<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Turma;
use Illuminate\Support\Facades\Auth;

class Aluno extends Model
{
    protected $fillable =
    [
        'NOME', 'NASCIMENTO', 'uuid', 'CERTIDAO_CIVIL', 'MODELO_CERTIDAO', 'MATRICULA_CERTIDAO', 'DADOS_CERTIDAO',
        'EXPEDICAO_CERTIDAO', 'NUMERO_RG', 'ORGAO_EXPEDIDOR_RG', 'EXPEDICAO_RG', 'CPF', 'NATURALIDADE', 'ESTADO',
        'NACIONALIDADE', 'SEXO', 'NIS', 'BOLSA_FAMILIA', 'SUS', 'NECESSIDADES_ESPECIAIS', 'NECESSIDADES_ESPECIAIS_DESCRICACAO',
        'NECESSIDADES_ESPECIAIS_CODIGO', 'COR', 'FONE', 'FONE_II', 'EMAIL', 'MAE', 'PROF_MAE', 'PAI', 'PROF_PAI', 'ENDERECO',
        'URBANO', 'CIDADE', 'CIDADE_ESTADO', 'TRANSPORTE', 'PONTO_ONIBUS', 'MOTORISTA', 'MOTORISTA_II', 'OBSERVACOES', 'EXCLUIDO',
        'EXCLUIDO_PASTA', 'ATUALIZACAO'
    ];
    /*
     *Filtra os alunos da index
     */
    public function search($filter = null)
    {
        $results = $this->where('NOME', 'LIKE', "%{$filter}%")->paginate(10);

        return $results;
    }
    /*
    *Relacionamento entre aluno e log(suas atualizações)
    */
    public function atualizacoes()
    {
        return $this->belongsToMany(Log::class, 'aluno_log')->withPivot(['ACAO', 'ACAO_DETALHES', 'user_id', 'aluno_id']);
    }

    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'aluno_turma')->withPivot([
            'OUVINTE', 'classificacao_id', 'turma_id', 'aluno_id', 'DECLARACAO', 'id',
            'DECLARACAO_DATA', 'DECLARACAO_RESPONSAVEL', 'TRANSFERENCIA', 'TRANSFERENCIA_DATA', 'TRANSFERENCIA_RESPONSAVEL'
        ]);
    }

    public function classificacaos()
    {
        return $this->belongsToMany(Classificacao::class, 'aluno_turma');
    }

    public function solicitacaos()
    {
        return $this->belongsToMany(Solicitacao::class, 'aluno_solicitacao')->withPivot([
            'aluno_id', 'SOLICITANTE', 'solicitacao_id', 'turma_id', 'aluno_id', 'id', 'TRANSFERENCIA_STATUS',
            'DATA_TRANSFERENCIA_STATUS', 'RESPONSAVEL_TRANSFERENCIA', 'DATA_TRANSFERENCIA', 'TRANSFERENCIA',
            'DATA_DECLARACAO', 'DECLARACAO', 'RESPONSAVEL_DECLARACAO'
        ]);
    }
    /*
    Listar as turmas do ano corrente
     */
    public function correntTurmas()
    {
        $ano = date('Y');
        $alunos = DB::table('aluno_turma')->where('turma_ano', 'LIKE', '%' . "$ano" . '%')
            ->where('aluno_turma.EXCLUIDO', 'LIKE', 'NAO')
            ->whereIn('aluno_turma.classificacao_id', [1, 2])
            ->join('alunos', 'aluno_turma.aluno_id', '=', 'alunos.id')
            ->join('turmas', 'aluno_turma.turma_id', '=', 'turmas.id')
            ->select('aluno_turma.aluno_id', 'alunos.NOME', 'aluno_turma.turma_id', 'aluno_turma.classificacao_id')
            ->orderBy('aluno_turma.turma_id', 'ASC')->orderBy('alunos.NOME', 'ASC')
            // ->toSql();
            ->get();
        //dd($alunos);

        $alunos_id[] = "";
        $turmas_id[] = "";
        foreach ($alunos as $dados) {
            foreach ($dados as $key => $value) {
                if ($key == "aluno_id") {
                    array_push($alunos_id, $value);
                }
                if ($key == "turma_id") {
                    array_push($turmas_id, $value);
                }
            }
        }
        array_shift($alunos_id);
        array_shift($turmas_id);

        $alunoTurmas = collect([]);
        foreach ($alunos_id as $key => $nulo) {
            $alunoTurmas = $alunoTurmas->concat(Aluno::with(['turmas' => function ($query) use ($turmas_id, $key) {
                $query->where('turma_id', $turmas_id[$key]);
            }])->where('id', $alunos_id[$key])->get());
        }
        return $alunoTurmas;
    }
    /*
    Recupera as turmas em que o aluno não está matriculado
    */
    public function turmasAvailable($filter = null)
    {
        $turmas = Turma::whereNotIn('id', function ($query) {
            $query->select('aluno_turma.turma_id');
            $query->from('aluno_turma');
            $query->whereRaw("aluno_turma.aluno_id={$this->id}");
        })
            // ->where(function ($queryFilter) use ($filter) {
            //     if($filter)
            //     $queryFilter->where('turmas.', 'LIKE', "%{$filter}%");
            // })
            // ->toSql();
            ->paginate();

        return $turmas;
    }
    /*
    *Coloca/atualiza os alunos na turma
    */
    public function attach($request, $aluno)
    {
        if (isset($request->turma_id)) {
            foreach ($request->turma_id as $turma) {
                $posionId = explode('/', $turma);
                $posion = $posionId[0];
                $turma_id = $posionId[1];

                $aluno->turmas()->updateExistingPivot($turma_id, [
                    'classificacao_id' => $request->classificacao_id[$posion], 'OUVINTE' => $request->OUVINTE[$posion],
                    'DECLARACAO' => $request->DECLARACAO[$posion], 'DECLARACAO_DATA' => $request->DECLARACAO_DATA[$posion],
                    'DECLARACAO_RESPONSAVEL' => $request->DECLARACAO_RESPONSAVEL[$posion], 'TRANSFERENCIA' => $request->TRANSFERENCIA[$posion],
                    'TRANSFERENCIA_DATA' => $request->TRANSFERENCIA_DATA[$posion], 'TRANSFERENCIA_RESPONSAVEL' => $request->TRANSFERENCIA_RESPONSAVEL[$posion],
                    'TURMA_ANO' => '2020-02-02', 'updated_at' => NOW()
                ]);
            }
        }

        if (isset($request->turma_id_02)) {
            foreach ($request->turma_id_02 as $turma) {
                $posionId = explode('/', $turma);
                $posion = $posionId[0];
                $turma_id = $posionId[1];

                $aluno->turmas()->attach($turma_id, [
                    'classificacao_id' => $request->classificacao_id_02[$posion], 'OUVINTE' => $request->OUVINTE_02[$posion],
                    'DECLARACAO' => $request->DECLARACAO_02[$posion], 'DECLARACAO_DATA' => $request->DECLARACAO_DATA_02[$posion],
                    'DECLARACAO_RESPONSAVEL' => $request->DECLARACAO_RESPONSAVEL_02[$posion], 'TRANSFERENCIA' => $request->TRANSFERENCIA_02[$posion],
                    'TRANSFERENCIA_DATA' => $request->TRANSFERENCIA_DATA_02[$posion], 'TRANSFERENCIA_RESPONSAVEL' => $request->TRANSFERENCIA_RESPONSAVEL_02[$posion],
                    'TURMA_ANO' => '2020-02-02', 'updated_at' => NOW()
                ]);
            }
        }
    }
    /*
    *Retira os alunos da turma
    */
    public function detach($request, $aluno)
    {
        if (isset($request->turma_id)) {
            foreach ($request->turma_id as $turma) {
                $posionId = explode('/', $turma);
                $turma_id = $posionId[1];;
                $aluno->turmas()->detach($turma_id);
            }
        }
    }
    /*
     *Edit em bloco na tabela aluno_turma
     */
    public function alunosFiltrados($request)
    {
        $ids[] = "";

        foreach ($request->aluno_selecionado as $turma) {
            $posionId = explode('/', $turma);
            $id = $posionId[2];
            array_push($ids, $id);
        }
        array_shift($ids);

        $alunos = DB::table('aluno_turma')->whereIn('aluno_turma.id', $ids)
            ->join('alunos', 'aluno_turma.aluno_id', '=', 'alunos.id')
            ->join('turmas', 'aluno_turma.turma_id', '=', 'turmas.id')
            ->join('classificacaos', 'aluno_turma.classificacao_id', '=', 'classificacaos.id')
            ->select('aluno_turma.turma_id', 'aluno_turma.aluno_id', 'alunos.NOME', 'aluno_turma.classificacao_id')
            ->orderBy('aluno_turma.turma_id', 'ASC')->orderBy('alunos.NOME', 'ASC')
            ->get();

        $alunos_id[] = "";
        $turmas_id[] = "";
        $classificacos_id[] = "";

        foreach ($alunos as $dados) {
            foreach ($dados as $key => $value) {
                if ($key == "aluno_id") {
                    array_push($alunos_id, $value);
                }
                if ($key == "turma_id") {
                    array_push($turmas_id, $value);
                }
                if ($key == "classificacao_id") {
                    array_push($classificacos_id, $value);
                }
            }
        }
        array_shift($alunos_id);
        array_shift($turmas_id);
        array_shift($classificacos_id);

        $alunoTurmas = collect([]);

        foreach ($alunos_id as $key => $nulo) {
            $alunoTurmas = $alunoTurmas->concat(Aluno::with(['turmas' => function ($query) use ($turmas_id, $key) {
                $query->where('turma_id', $turmas_id[$key]);
            }, 'classificacaos' => function ($query) use ($classificacos_id, $key) {
                $query->where('classificacao_id', $classificacos_id[$key]);
            }])->where('id', $alunos_id[$key])->get());
        }

        return $alunoTurmas;
    }
    /*
    * Atualiza os vínculos das turmas e alunos em bloco, pelo update.
    */
    public function upAttach($request)
    {
        foreach ($request->aluno_selecionado as $value) {

            $posionId = explode('/', $value);
            $turma_id = $posionId[1];
            $id = $posionId[2];

            $alunoTurmas = DB::table('aluno_turma')->where('id', $id)->update(['turma_id' => $request->turma_id, 'classificacao_id' => $request->classificacao_id]);
        }
    }
    /*
    *Coloca a solicitação do aluno na tabela de transferencias
    */
    public function solicitacaoAttach($request, $aluno)
    {
        $aluno->solicitacaos()->attach('1', [
            'DATA_SOLICITACAO' => $request->DATA_SOLICITACAO, 'SOLICITANTE' => $request->SOLICITANTE, 'turma_id' => $request->turma_id
        ]);
        /* LOG DO ALUNO */
        $usuario = Auth::user()->id;
        DB::table('aluno_log')->insert(
            ['aluno_id' => $aluno->id, 'ACAO' => 'INSERIR', 'ACAO_DETALHES' => 'SOLICITAÇÃO DE TRANSFERÊNCIA', 'log_id' => '1', 'user_id' => $usuario,]
        );
    }
    /*
    Solicitações de transferência que o aluno pediu e estão pendentes
    */
    public function solicitacoesAvailable($aluno_id)
    {
        $alunoSolicitacaoCont = DB::table('aluno_solicitacao')->where('aluno_id', $aluno_id)->where('TRANSFERENCIA_STATUS', 'LIKE', 'PENDENTE')
            ->join('alunos', 'aluno_solicitacao.aluno_id', '=', 'alunos.id')
            ->join('turmas', 'aluno_solicitacao.turma_id', '=', 'turmas.id')
            ->select('aluno_solicitacao.turma_id', 'aluno_solicitacao.aluno_id', 'alunos.NOME', 'aluno_solicitacao.id')
            ->orderBy('aluno_solicitacao.created', 'DESC')->count();

        return $alunoSolicitacaoCont;
    }
    /*
    Solicitações de transferência que o aluno pediu
    */
    public function solicitacoesAluno($uuid)
    {
        $aluno = DB::table('alunos')->where('uuid', $uuid)->first();

        $alunos = DB::table('aluno_solicitacao')->where('aluno_id', $aluno->id)
            ->join('alunos', 'aluno_solicitacao.aluno_id', '=', 'alunos.id')
            ->join('turmas', 'aluno_solicitacao.turma_id', '=', 'turmas.id')
            ->select(
                'alunos.NOME',
                'aluno_solicitacao.turma_id',
                'aluno_solicitacao.aluno_id',
                'aluno_solicitacao.solicitacao_id'
            )
            ->orderBy('aluno_solicitacao.created_at', 'DESC')->get();

        $alunos_id[] = "";
        $turmas_id[] = "";
        $solicitacao_id[] = "";

        foreach ($alunos as $dados) {
            foreach ($dados as $key => $value) {
                if ($key == "aluno_id") {
                    array_push($alunos_id, $value);
                }
                if ($key == "turma_id") {
                    array_push($turmas_id, $value);
                }
                if ($key == "solicitacao_id") {
                    array_push($solicitacao_id, $value);
                }
            }
        }
        array_shift($alunos_id);
        array_shift($turmas_id);
        array_shift($solicitacao_id);

        $solicitacoesAluno = collect([]);

        foreach ($alunos_id as $key => $nulo) {
            $solicitacoesAluno = $solicitacoesAluno->concat(Aluno::with(['turmas' => function ($query) use ($turmas_id, $key) {
                $query->where('turma_id', $turmas_id[$key]);
            }, 'solicitacaos' => function ($query) use ($solicitacao_id, $key) {
                $query->where('solicitacao_id', $solicitacao_id[$key]);
            }])->where('id', $alunos_id[$key])->get());
        }

        return $solicitacoesAluno;
    }
    /*
    Listar os alunos transferidos
     */
    public function transferidos()
    {
        $alunos = DB::table('aluno_solicitacao')
            ->join('alunos', 'aluno_solicitacao.aluno_id', '=', 'alunos.id')
            ->join('turmas', 'aluno_solicitacao.turma_id', '=', 'turmas.id')
            ->select('aluno_solicitacao.aluno_id', 'alunos.NOME', 'aluno_solicitacao.turma_id', 'aluno_solicitacao.solicitacao_id')
            ->orderBy('aluno_solicitacao.turma_id', 'ASC')->orderBy('alunos.NOME', 'ASC')
            // ->toSql();
            ->get();
        //dd($alunos);

        $alunos_id[] = "";
        $turmas_id[] = "";
        $solicitacao_id[] = "";

        foreach ($alunos as $dados) {
            foreach ($dados as $key => $value) {
                if ($key == "aluno_id") {
                    array_push($alunos_id, $value);
                }
                if ($key == "turma_id") {
                    array_push($turmas_id, $value);
                }
                if ($key == "solicitacao_id") {
                    array_push($solicitacao_id, $value);
                }
            }
        }
        array_shift($alunos_id);
        array_shift($turmas_id);
        array_shift($solicitacao_id);

        $alunoTurmasTransfridos = collect([]);

        foreach ($alunos_id as $key => $nulo) {
            $alunoTurmasTransfridos = $alunoTurmasTransfridos->concat(Aluno::with(['turmas' => function ($query) use ($turmas_id, $key) {
                $query->where('turma_id', $turmas_id[$key]);
            }, 'solicitacaos' => function ($query) use ($solicitacao_id, $key) {
                $query->where('solicitacao_id', $solicitacao_id[$key]);
            }])->where('id', $alunos_id[$key])->get());
        }
        return $alunoTurmasTransfridos;
    }
    /*
    *Atualiza o pedido de transferência do aluno
    */
    public function solicitacoesUpdate($request)
    {
        foreach ($request->aluno_selecionado as $id) {
            $posionId = explode('/', $id);
            $aluno_uuid = $posionId[0];
            $turma_id = $posionId[1];
            $pivot_id = $posionId[2];
        }
        $aluno = Aluno::where('uuid', $aluno_uuid)->first();

        if ($request->DATA_TRANSFERENCIA == "") {
            $request->DATA_TRANSFERENCIA = date('Y-m-d');
        }
        if ($request->DATA_DECLARACAO == "") {
            $request->DATA_DECLARACAO = date('Y-m-d');
        }
        if ($request->DATA_TRANSFERENCIA_STATUS == "") {
            $request->DATA_TRANSFERENCIA_STATUS = date('Y-m-d');
        }

        $aluno_solicitacao = DB::table('aluno_solicitacao')
            ->where('id', $pivot_id)
            ->update([
                'TRANSFERENCIA_STATUS' => $request->TRANSFERENCIA_STATUS, 'DATA_TRANSFERENCIA_STATUS' => "$request->DATA_TRANSFERENCIA_STATUS",
                'DECLARACAO' => "$request->DECLARACAO", 'RESPONSAVEL_DECLARACAO' => "$request->RESPONSAVEL_DECLARACAO",
                'SOLICITANTE' => "$request->SOLICITANTE", 'DATA_DECLARACAO' => "$request->DATA_DECLARACAO", 'TRANSFERENCIA' => "$request->TRANSFERENCIA",
                'RESPONSAVEL_TRANSFERENCIA' => "$request->RESPONSAVEL_TRANSFERENCIA", 'DATA_TRANSFERENCIA' => "$request->DATA_TRANSFERENCIA"
            ]);
        $aluno_turma = DB::table('aluno_turma')
            ->where('turma_id', $turma_id)->where('aluno_id', $aluno->id)
            ->update(['classificacao_id' => $request->classificacao_id, 'updated_at' => NOW()]);
    }
}
