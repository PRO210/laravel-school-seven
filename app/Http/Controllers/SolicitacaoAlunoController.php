<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Classificacao;
use App\Models\Solicitacao;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Auth;
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
        $alunoTurmasTransfridos = $this->aluno->transferidos();
        //dd($alunoTurmasTransfridos);
        $classificacoes = $this->classificacao->get();

        return view('turmas.alunos.solicitacoes.index', compact('alunoTurmasTransfridos', 'classificacoes'));
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
        //dd($alunoSolicitacaoCont);
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

        return redirect()->action('SolicitacaoAlunoController@show', ['uuid' => $request->aluno_id])->with('message', 'Operação Realizada com Sucesso!');
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
            $turma_id = $posionId[1];
            $pivot_id = $posionId[2];
        }
        // $solicitacoesAluno = DB::table('aluno_solicitacao')->where('id', $pivot_id)->get();
        $solicitacoesAluno = DB::table('aluno_solicitacao')->where('aluno_solicitacao.id', $pivot_id)
            ->join('aluno_turma', 'aluno_solicitacao.turma_id', '=', 'aluno_turma.turma_id')
            ->select('aluno_turma.classificacao_id', 'aluno_solicitacao.*')
            ->get();

        // foreach ($solicitacoesAluno as $value) {
        //     foreach ($value as $key => $value02) {
        //         $html[$key][] = $value02;
        //         // echo "$value02" . ' , ';
        //     }
        // }
        // echo json_encode($html);
        // $("#SOLICITANTE").val(response.SOLICITANTE)

        return response()->json($solicitacoesAluno);
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
        if (!isset($request->aluno_selecionado)) {
            return redirect()->back()->with('error', 'Falha em Salvar os Dados!');
        }

        $solicitacoesUpdate = $this->aluno->solicitacoesUpdate($request);

        foreach ($request->aluno_selecionado as $id) {
            $posionId = explode('/', $id);
            $aluno_uuid = $posionId[0];
        }

        return redirect()->action('SolicitacaoAlunoController@show', ['uuid' => $aluno_uuid])->with('message', 'Operação Realizada com Sucesso!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid, $turma_id)
    {
        $aluno = $this->aluno->where('uuid', $uuid)->first();



        $aluno_solicitacao = DB::table('aluno_solicitacao')->where('turma_id', $turma_id)->where('aluno_id', $aluno->id)->delete();

        /* LOG DO ALUNO */
        $usuario = Auth::user()->id;
        DB::table('aluno_log')->insert([
            'aluno_id' => $aluno->id, 'ACAO' => 'DELETAR',
            'ACAO_DETALHES' => 'EXCLUÍU A SOLICITAÇÃO DE TRANSFERÊNCIA', 'log_id' => '3', 'user_id' => $usuario,
        ]);

        return redirect()->action('SolicitacaoAlunoController@index')->with('message', 'Operação Realizada com Sucesso!');
    }
    //
    //
}
