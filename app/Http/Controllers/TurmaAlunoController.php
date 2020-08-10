<?php

namespace App\Http\Controllers;

use App\Exports\AlunosFiltradosExport;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Classificacao;
use App\Models\Turma;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\Echo_;

class TurmaAlunoController extends Controller
{
    private $aluno, $turma;

    public function __construct(Turma $turma, Aluno $aluno, Classificacao $classificacao)
    {
        $this->turma = $turma;
        $this->aluno = $aluno;
        $this->classificacao = $classificacao;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunoTurmas = $this->aluno->correntTurmas();

        $classificacoes = $this->classificacao->get();

        return view('turmas.alunos.index', compact('alunoTurmas', 'classificacoes'));
    }
    /*
    *Alunos Desistentes
     */
    public function indexDesistentes()
    {
        $alunoTurmas = $this->aluno->indexDesistentes();

        $classificacoes = $this->classificacao->get();

        return view('turmas.alunos.indexDesistentes', compact('alunoTurmas', 'classificacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $alunoTurmas = $this->aluno->with(['turmas'])->where('uuid', $uuid)->get();
        //dd($alunoTurmas);
        $aluno = $this->aluno->where('uuid', $uuid)->first();

        $turmas = $aluno->turmasAvailable();

        $classificacoes = $this->classificacao->where('ORDEM_I', 'LIKE', 'SIM')->get();
        //dd($classificacoes);

        return view('turmas.alunos.show', compact('turmas', 'alunoTurmas', 'aluno', 'classificacoes'));
    }

    /**c
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if ($request->botao == "excel") {
            return Excel::download(new AlunosFiltradosExport($request->aluno_selecionado), 'Alunos.xlsx');
        }

        $alunos = $this->aluno->alunosFiltrados($request);

        $turmas = $this->turma->get();

        $classificacoes = $this->classificacao->where('ORDEM_I', 'SIM')->get();

        return view('turmas.alunos.edit', compact('turmas', 'alunos', 'classificacoes'));
    }
    //
    //

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->botao == "transferencia") {

            $upBlocoSolcitacaoAttach = $this->aluno->upBlocoSolcitacaoAttach($request);
            return redirect()->route('turmas.alunos.solicicaos')->with('message', 'Operação Realizada com Sucesso!');
        }

        $upAttach = $this->aluno->upAttach($request);
        return redirect()->route('turmas.alunos')->with('message', 'Operação Realizada com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Atualiza os vínculos das turmas e alunos
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function attachTurmasAluno(Request $request, $uuid)
    {
        $aluno = $this->aluno->where('uuid', $uuid)->first();

        if ($request->salvar == "salvar") {
            $attach = $this->aluno->attach($request, $aluno);
            return redirect()->action('TurmaAlunoController@show', ['uuid' => $uuid])->with('message', 'Operação Realizada com Sucesso!');
        } else {
            $detach = $this->aluno->detach($request, $aluno);
            // return redirect()->route('turmas.index')->with('message', 'Operação Realizada com Sucesso!');
            return redirect()->action('TurmaAlunoController@show', ['uuid' => $uuid])->with('message', 'Operação Realizada com Sucesso!');
        }
    }
    /*
    *Arquivar os alunos
    */
    public function arquivar($uuid, $turma_id)
    {
        $aluno = $this->aluno->where('uuid', $uuid)->first();
        $aluno->turmas()->updateExistingPivot($turma_id, ['classificacao_id' => '8', 'updated_at' => NOW()]);

        /* LOG DOS ALUNOS */
        $usuario = Auth::user()->id;
        DB::table('aluno_log')->insert(
            ['aluno_id' => $aluno->id, 'ACAO' => 'DELETE', 'log_id' => '3', 'ACAO_DETALHES' => 'ARQUIVADO', 'user_id' => $usuario,]
        );

        return redirect()->route('alunos.index')->with('message', 'Operações Realizadas com Sucesso!');
    }
    /*
    *Resumo dos alunoa e turmas
    */
    public function resumo()
    {
        $alunoTurmas = $this->turma->with(['manhaAlunos'])->where('TURNO', 'LIKE', 'MATUTINO')->get();


        foreach ($alunoTurmas as $turma) {

            echo $turma->TURMA . ': ';

            $contCur = 0;

            foreach ($turma->manhaAlunos as $key => $aluno) {
                echo $aluno->NOME . ', ';
                $contCur += $contCur + 1;
            }

            echo ' - ' . $contCur;
            echo "<br>";
        }



        dd($alunoTurmas);

        return view('turmas.alunos.resumo', compact('alunoTurmas'));
    }
    //
    //
}
