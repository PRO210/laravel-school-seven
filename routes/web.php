<?php

use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {

        /**
         * Role x User
         */
        Route::get('users/{id}/role/{idRole}/detach', 'ACL\RoleUserController@detachRoleUser')->name('users.role.detach');
        Route::post('users/{id}/roles', 'ACL\RoleUserController@attachRolesUser')->name('users.roles.attach');
        Route::any('users/{id}/roles/create', 'ACL\RoleUserController@rolesAvailable')->name('users.roles.available');
        Route::get('users/{id}/roles', 'ACL\RoleUserController@roles')->name('users.roles');
        Route::get('roles/{id}/users', 'ACL\RoleUserController@users')->name('roles.users');
        /**
         * Permission x Role
         */
        Route::get('roles/{id}/permission/{idPermission}/detach', 'ACL\PermissionRoleController@detachPermissionRole')->name('roles.permission.detach');
        Route::post('roles/{id}/permissions', 'ACL\PermissionRoleController@attachPermissionsRole')->name('roles.permissions.attach');
        Route::any('roles/{id}/permissions/create', 'ACL\PermissionRoleController@permissionsAvailable')->name('roles.permissions.available');
        Route::get('roles/{id}/permissions', 'ACL\PermissionRoleController@permissions')->name('roles.permissions');
        Route::get('permissions/{id}/role', 'ACL\PermissionRoleController@roles')->name('permissions.roles');
        /**
         * Routes Roles
         */
        Route::any('roles/search', 'ACL\RoleController@search')->name('roles.search');
        Route::resource('roles', 'ACL\RoleController');


        /**
         * Routes Users
         */
        Route::any('users/search', 'UserController@search')->name('users.search');
        Route::resource('users', 'UserController');
        // Aplicar o Gate direto na rota
        // Route::resource('users', 'UserController')->middleware('can:Users');
        /**
         * Plan x Profile
         */
        Route::get('plans/{id}/profile/{idProfile}/detach', 'ACL\PlanProfileController@detachProfilePlan')->name('plans.profile.detach');
        Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@attachProfilesPlan')->name('plans.profiles.attach');
        Route::any('plans/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');
        Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');
        Route::get('profiles/{id}/plans', 'ACL\PlanProfileController@plans')->name('profiles.plans');
        /**
         * Permission x Profile
         */
        Route::get('profiles/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionProfile')->name('profiles.permission.detach');
        Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
        Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
        Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
        Route::get('permissions/{id}/profile', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');
        //
        /**
         * Routes Permissions
         */
        Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
        Route::resource('permissions', 'ACL\PermissionController');
        //
        // Router Profiles      // Router Profiles      // Router Profiles
        Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
        Route::resource('profiles', 'ACL\ProfileController');
        //
        //
        //Routes Details Plan       //Routes Details Plan       //Routes Details Plan
        Route::delete('/plans/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy');
        Route::put('/plans/{url}/details/{idDetail}', 'DetailPlanController@update')->name('details.plan.update');
        Route::get('/plans/{url}/details/{idPlan}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
        Route::get('/plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');
        Route::post('/plans/{url}/details/', 'DetailPlanController@store')->name('details.plan.store');
        Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
        Route::get('/plans/{url}/details/{idDetail}', 'DetailPlanController@show')->name('details.plan.show');
        //
        //Planos        //Planos        //Planos
        Route::put('/plans/{url}/', 'PlanController@update')->name('plans.update');
        Route::any('/plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
        Route::any('/search', 'PlanController@search')->name('plans.search');
        Route::get('/plans', 'PlanController@index')->name('plans.index');
        Route::post('/plans', 'PlanController@store')->name('plans.store');
        Route::get('/plans/create/', 'PlanController@create')->name('plans.create');
        Route::get('/plans/{url}', 'PlanController@show')->name('plans.show');
        Route::delete('/plans/{url}', 'PlanController@delete')->name('plans.delete');
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

        Route::post('/relatorios/gerados', 'TurmaAlunoController@gerarRelatorios')->name('turmas.alunos.relatorios.gerados');
        Route::get('/relatorios', 'TurmaAlunoController@relatorios')->name('turmas.alunos.relatorios');
        Route::get('/resumo', 'TurmaAlunoController@contCorrentTurmas')->name('turmas.alunos.resumo');
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



// Route::get('/', function () {
//     return view('welcome');
// });
/**
 * Site
 */
Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');

Route::get('/home', function () {
    return view('admin/pages/home/home');
})->name('home')->middleware('auth');

Route::get('home/users/export/', 'UsersController@export');
Route::get('home/users/export/pdf/', 'UsersController@fpdfexport');


Auth::routes();
