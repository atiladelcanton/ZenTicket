<?php

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('grupos')->middleware('needsPermission')->group(function () {
    Route::get('/', ['shield' => ['grupos.index'], 'uses' => 'RolesController@index'])->name('grupos');
    Route::get('/criar', ['shield' => ['grupos.create'], 'uses' => 'RolesController@create'])->name('grupos.create');
    Route::post('/criar', ['shield' => ['grupos.create'], 'uses' => 'RolesController@store'])->name('grupos.registrar');
    Route::get('/editar/{id}', ['shield' => ['grupos.edit'], 'uses' => 'RolesController@edit'])->name('grupos.editar');
    Route::post(
        '/editar/{id}',
        ['shield' => ['grupos.edit'], 'uses' => 'RolesController@update']
    )->name('grupos.alterar');
    Route::delete(
        '/{id}',
        ['shield' => ['grupos.destroy'], 'uses' => 'RolesController@destroy']
    )->name('grupos.deletar');
});

Route::prefix('usuarios')->middleware('needsPermission')->group(function () {
    Route::get('/', ['shield' => ['usuarios.index'], 'uses' => 'UsersController@index'])->name('usuarios');
    Route::get('/criar',['shield' => ['usuarios.create'], 'uses' => 'UsersController@create'])->name('usuarios.create');
    Route::post('/criar',['shield' => ['usuarios.create'], 'uses' => 'UsersController@store'])->name('usuarios.registrar');
    Route::get('/editar/{id}',['shield' => ['usuarios.edit'], 'uses' => 'UsersController@edit'])->name('usuarios.editar');
    Route::post('/editar/{id}',['shield' => ['usuarios.edit'], 'uses' => 'UsersController@update'])->name('usuarios.alterar');
    Route::delete('/{id}',['shield' => ['usuarios.destroy'], 'uses' => 'UsersController@destroy'])->name('usuarios.deletar');
});

Route::prefix('chamados')->middleware('needsPermission')->group(function () {
    Route::get('/', ['shield' => ['usuarios.index'], 'uses' => 'UsersController@index'])->name('chamados');
    Route::get('/criar',['shield' => ['usuarios.create'], 'uses' => 'UsersController@create'])->name('chamados.create');
    Route::post('/criar',['shield' => ['usuarios.create'], 'uses' => 'UsersController@store'])->name('chamados.registrar');
    Route::get('/editar/{id}',['shield' => ['usuarios.edit'], 'uses' => 'UsersController@edit'])->name('chamados.editar');
    Route::post('/editar/{id}',['shield' => ['usuarios.edit'], 'uses' => 'UsersController@update'])->name('chamados.alterar');
    Route::delete('/{id}',['shield' => ['usuarios.destroy'], 'uses' => 'UsersController@destroy'])->name('chamados.deletar');
});

Route::prefix('projetos')->middleware('needsPermission')->group(function () {
    Route::get('/', ['shield' => ['projetos.index'], 'uses' => 'ProjectController@index'])->name('projetos');
    Route::get('/criar',['shield' => ['projetos.create'], 'uses' => 'ProjectController@create'])->name('projetos.create');
    Route::post('/criar',['shield' => ['projetos.create'], 'uses' => 'ProjectController@store'])->name('projetos.registrar');
    Route::get('/editar/{id}',['shield' => ['projetos.edit'], 'uses' => 'ProjectController@edit'])->name('projetos.editar');
    Route::post('/editar/{id}',['shield' => ['projetos.edit'], 'uses' => 'ProjectController@update'])->name('projetos.alterar');
    Route::delete('/{id}',['shield' => ['projetos.destroy'], 'uses' => 'ProjectController@destroy'])->name('projetos.deletar');
});

Route::group(['configuacoes','prefix'=>'configuracoes'],function (){
    include 'prioridade/web.php';
    include 'tipos_ticket/web.php';
    include 'impactos/web.php';
    include 'status_ticket/web.php';
});
