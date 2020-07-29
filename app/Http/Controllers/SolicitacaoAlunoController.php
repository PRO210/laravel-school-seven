<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Classificacao;
use App\Models\Solicitacao;
use Illuminate\Support\Facades\DB;

class SolicitacaoAlunoController extends Controller
{
    private $aluno, $turma, $classificacao, $solicitacao;

    public function __construct(Solicitacao $solicitacao, Turma $turma, Aluno $aluno, Classificacao $classificacao)
    {
        $this->turma = $turma;
        $this->aluno = $aluno;
        $this->classificacao = $classificacao;
        $this->solicitacao = $solicitacao;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uuid, $turma_id)
    {
        $aluno = $this->aluno->where('uuid', $uuid)->first();

        $alunoSolicitacaoCont = $this->aluno->solicitacoesAvailable($aluno->id);

        $turma = $this->turma->where('id', $turma_id)->first();

        $alunoSolicitacao = $this->aluno->with(['solicitacaos'])->where('uuid', $uuid)->get()->count();

        return view('turmas.alunos.solicitacoes.create', compact('alunoSolicitacao', 'alunoSolicitacaoCont', 'aluno', 'turma'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        if ($request->botao == "pesquisar") {
            return redirect()->action('SolicitacaoAlunoController@show', ['uuid' => $request->aluno_id]);
        }

        $aluno = $this->aluno->where('uuid', $request->aluno_id)->first();

        $solicitacaoAttach = $this->aluno->solicitacaoAttach($request, $aluno);

        return redirect()->action('SolicitacaoAlunoController@show', ['id' => $aluno->id])->with('message', 'Operação Realizada com Sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $solicitacoesAluno = $this->aluno->solicitacoesAluno($uuid);
        $classificacoes = $this->classificacao->get();


        return view('turmas.alunos.solicitacoes.show', compact('solicitacoesAluno', 'classificacoes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        foreach ($request->aluno_selecionado as $id) {
            $posionId = explode('/', $id);
            $pivot_id = $posionId[2];
        }

        $solicitacoesAluno = DB::table('aluno_solicitacao')->where('id', $pivot_id)->get();

        foreach ($solicitacoesAluno as $value) {

            foreach ($value as $key => $value02) {
                $html[$key][] = $value02;
                // echo "$value02" . ' , ';
            }
        }

        echo json_encode($html);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        dd($request);
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
}
