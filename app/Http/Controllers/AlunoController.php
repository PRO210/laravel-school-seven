<?php

namespace App\Http\Controllers;

use App\Exports\AlunosExport;
use App\Http\Requests\StoreUpdateAluno;
use App\Models\Aluno;
use App\Models\Classificacao;
use App\Models\Documento;
use App\Models\Log;
use App\Models\Turma;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class AlunoController extends Controller
{
    private $repository, $classificacao, $user, $turma;

    public function __construct(Aluno $aluno, Turma $turma, Classificacao $classificacao, Documento $documento, User $user)
    {
        $this->repository = $aluno;
        $this->turma = $turma;
        $this->classificacao = $classificacao;
        $this->documento = $documento;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $alunos = $this->repository->latest()->paginate(5);
        $alunos = DB::table('alunos')->orderBy('NOME', 'ASC')->get();
        // dd($alunos);
        return view('alunos.index', compact('alunos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alunos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateAluno $request)
    {
        $aluno = $this->repository->create($request->all());

        $usuario = Auth::user()->id;

        DB::table('aluno_log')->insert(
            ['aluno_id' => $aluno->id, 'ACAO' => 'INSERIR', 'log_id' => '1', 'ACAO_DETALHES' => 'Inserção no Sistema', 'user_id' => $usuario,]
        );

        return redirect()->route('alunos.index')->with('message', 'Operação Realizada com Sucesso!');;
        // return redirect()->action('Alunos\AlunoController@cursando', ['id' => '0'])->with('msg', 'Alterações Salvas com Sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /*
    *dataTable
     */
    public function dataTable()
    {
        // $alunoTurmas = $this->repository->correntTurmas();

        $aluno = $this->repository->where('id', 1)->first();

        $logAlunos = $this->repository->with('atualizacoes')->where('id', $aluno->id)->get();

        foreach ($logAlunos as $logAluno) {
            foreach ($logAluno->atualizacoes as $atualizacao) {
                echo $atualizacao->pivot->ACAO . ' - ' . $atualizacao->pivot->ACAO_DETALHES;
                echo "<br>";
            }
        }
        // dd($logAlunos);

        $classificacoes = $this->classificacao->get();

        $users = $this->user->all();


        return view('alunos.table', compact('logAlunos', 'classificacoes', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $aluno = $this->repository->where('uuid', $uuid)->first();

        $logAlunos = $this->repository->with(['atualizacoes'])->where('id', $aluno->id)->latest()->paginate(5);


        $users = $this->user->all();

        $documentos = $this->documento->all();

        return view('alunos.edit', compact('aluno', 'documentos', 'logAlunos', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $alunos = $this->repository->where('uuid', $uuid)->first();

        $backup = $this->repository->find($alunos->id);

        $alunos->update($request->except('_token', '_method'));

        $backup_update = $this->repository->find($alunos->id);

        $result = array_diff_assoc($backup_update->toArray(), $backup->toArray());
        $campo = "";
        $campo_final = "";

        foreach ($result as $nome_campo => $valor) {
            if ($backup[$nome_campo] == "") {
                $backup[$nome_campo] = "Vazio";
            }
            if ($valor == "") {
                $valor = "Vazio";
            }
            $campo .= "$nome_campo = De $backup[$nome_campo] para $valor / ";
        }
        $campo_final = "Alterou o(s) Campo(s) de " . $backup['NOME'] . " em : $campo ";

        $usuario = Auth::user()->id;
        DB::table('aluno_log')->insert(
            ['aluno_id' => $alunos->id, 'ACAO' => 'EDITAR', 'log_id' => '2', 'ACAO_DETALHES' => $campo_final, 'user_id' => $usuario,]
        );

        return redirect()->route('alunos.index')->with('message', 'Operações Realizadas com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $alunos = $this->repository->where('uuid', $uuid)->delete();

        return redirect()->route('alunos.index')->with('message', 'Operações Realizadas com Sucesso!');
    }

    public function search(Request $request)
    {
        if ($request->botao == "excel") {
            return Excel::download(new AlunosExport($request->aluno_selecionado), 'Alunos.xlsx');
        }

        if ($request->botao == "update") {

            $alunos = collect([]);
            foreach ($request->aluno_selecionado as $uuid) {
                $alunos = $alunos->concat(Aluno::where('uuid', $uuid)->get());
            }

            $turmas = $this->turma->get();
            $classificacoes = $this->classificacao->where('ORDEM_III', 'LIKE', 'SIM')->get();

            return view('alunos.editBloco', compact('turmas', 'alunos', 'classificacoes'));
        }

        $filters = $request->except('_token');

        $alunos = $this->repository->search($request->filter);

        return view('alunos.index', ['alunos' => $alunos, 'filters' => $filters,]);
    }

    public function upBlocoAttach(Request $request)
    {
        $alunos = $this->repository->upBlocoAttach($request);

        return redirect()->route('turmas.alunos')->with('message', 'Operação Realizada com Sucesso!');
    }








    //
    //
}
