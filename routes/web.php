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
Route::prefix('turmas')
    ->group(function () {

        Route::put('/{id}/update', 'TurmaController@update')->name('turmas.update');
        Route::get('/alunos', 'TurmaAlunoController@index')->name('turmas.alunos');
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
Route::prefix('turma/alunos')
    ->group(function () {

        Route::put('/update', 'TurmaAlunoController@preUpdate')->name('turmas.alunos.update');
        Route::post('/{uuid}', 'TurmaAlunoController@attachTurmasAluno')->name('turmas.aluno.attach');
        Route::get('/{uuid}/show', 'TurmaAlunoController@show')->name('turmas.aluno.show');
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
