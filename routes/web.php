<?php

use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
        /**
         * Home Dashboard
         */
        Route::get('/', 'DashboardController@home')->name('admin.index');
    });
/*
         *Alunos
         */
Route::prefix('alunos')
    ->group(function () {


        Route::get('/table', 'AlunoController@dataTable')->name('alunos.table');
        Route::put('/search/upBlocoAttach', 'AlunoController@upBlocoAttach')->name('alunos.upBlocoAttach');
        Route::get('/{uuid}/destroy', 'AlunoController@destroy')->name('alunos.destroy');
        Route::put('/{uuid}/update', 'AlunoController@update')->name('aluno.update');
        Route::any('/{uuid}/edit', 'AlunoController@edit')->name('alunos.edit');
        Route::any('search', 'AlunoController@search')->name('alunos.search');
        Route::get('/', 'AlunoController@index')->name('alunos.index');
        Route::post('store', 'AlunoController@store')->name('alunos.store');
        Route::get('create', 'AlunoController@create')->name('alunos.create');
    });
/*
         *Turmas
         */
Route::prefix('turma')
    ->group(function () {

        Route::put('/{id}/update', 'TurmaController@update')->name('turmas.update');
        Route::any('/{id}/edit', 'TurmaController@edit')->name('turmas.edit');
        Route::any('search', 'TurmaController@search')->name('turmas.search');
        Route::get('/', 'TurmaController@index')->name('turmas.index');
        Route::post('turmas', 'TurmaController@store')->name('turmas.store');
        Route::get('create', 'TurmaController@create')->name('turmas.create');
        Route::get('/{id}/delete', 'TurmaController@delete')->name('turmas.delete');
    });
/*
         Turmas Alunos
         */
Route::prefix('turmas/alunos')
    ->group(function () {

        Route::get('/resumo', 'TurmaAlunoController@resumo')->name('turmas.alunos.resumo');
        Route::get('/{uuid}/solicitações/create/{turma_id}', 'SolicitacaoAlunoController@create')->name('turmas.aluno.solicitacao');
        Route::put('/update', 'TurmaAlunoController@update')->name('turmas.alunos.update');
        Route::put('/edit', 'TurmaAlunoController@edit')->name('turmas.alunos.edit');
        Route::post('/{uuid}', 'TurmaAlunoController@attachTurmasAluno')->name('turmas.aluno.attach');
        Route::get('/{uuid}/show', 'TurmaAlunoController@show')->name('turmas.aluno.show');
        Route::get('/desistentes', 'TurmaAlunoController@indexDesistentes')->name('turmas.alunos.desistentes');
        Route::get('', 'TurmaAlunoController@index')->name('turmas.alunos');
    });
    /*
    Turmas Alunos Solicitalções
    */
Route::prefix('turmas/alunos/solicitações')
    ->group(function () {


        Route::get('/{uuid}/arquivo/{turma_id}/destroy', 'SolicitacaoAlunoController@destroy')->name('turmas.aluno.solicicao.destroy');

        Route::get('/{uuid}/arquivo/{turma_id}', 'TurmaAlunoController@arquivar')->name('turmas.aluno.arquivo');
        Route::any('/{uuid}/arquivo/{turma_id}', 'SolicitacaoAlunoController@retirar')->name('turmas.aluno.arquivo.retirar');

        Route::post('/solicicao.update', 'SolicitacaoAlunoController@update')->name('turmas.aluno.solicicao.update');
        Route::post('/solicicao.edit', 'SolicitacaoAlunoController@edit')->name('turmas.aluno.solicicao.edit');
        Route::get('/{uuid}/show', 'SolicitacaoAlunoController@show')->name('turmas.aluno.solicicao.show');
        Route::post('/store', 'SolicitacaoAlunoController@store')->name('turmas.aluno.solicicao.store');
        Route::get('', 'SolicitacaoAlunoController@index')->name('turmas.alunos.solicicaos');

    });



Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('admin/pages/home/home');
})->name('home')->middleware('auth');

Route::get('home/users/export/', 'UsersController@export');
Route::get('home/users/export/pdf/', 'UsersController@fpdfexport');


Auth::routes();
