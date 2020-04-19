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
    Route::get('/', ['shield' => ['usuarios.index'], 'uses' => 'UsersController@index'])->name('projetos');
    Route::get('/criar',['shield' => ['usuarios.create'], 'uses' => 'UsersController@create'])->name('projetos.create');
    Route::post('/criar',['shield' => ['usuarios.create'], 'uses' => 'UsersController@store'])->name('projetos.registrar');
    Route::get('/editar/{id}',['shield' => ['usuarios.edit'], 'uses' => 'UsersController@edit'])->name('projetos.editar');
    Route::post('/editar/{id}',['shield' => ['usuarios.edit'], 'uses' => 'UsersController@update'])->name('projetos.alterar');
    Route::delete('/{id}',['shield' => ['usuarios.destroy'], 'uses' => 'UsersController@destroy'])->name('projetos.deletar');
});

Route::group(['configuacoes','prefix'=>'configuracoes'],function (){

    Route::prefix('sla')->middleware('needsPermission')->group(function () {
        Route::get('/', ['shield' => ['sla.index'], 'uses' => 'UsersController@index'])->name('sla');
        Route::get('/criar',['shield' => ['sla.create'], 'uses' => 'UsersController@create'])->name('sla.create');
        Route::post('/criar',['shield' => ['sla.create'], 'uses' => 'UsersController@store'])->name('sla.registrar');
        Route::get('/editar/{id}',['shield' => ['sla.edit'], 'uses' => 'UsersController@edit'])->name('sla.editar');
        Route::post('/editar/{id}',['shield' => ['sla.edit'], 'uses' => 'UsersController@update'])->name('sla.alterar');
        Route::delete('/{id}',['shield' => ['sla.destroy'], 'uses' => 'UsersController@destroy'])->name('sla.deletar');
    });


    Route::prefix('tipos-de-chamados')->middleware('needsPermission')->group(function () {
        Route::get('/', ['shield' => ['tipos-de-chamados.index'], 'uses' => 'UsersController@index'])->name('tipos-de-chamados');
        Route::get('/criar',['shield' => ['tipos-de-chamados.create'], 'uses' => 'UsersController@create'])->name('tipos-de-chamados.create');
        Route::post('/criar',['shield' => ['tipos-de-chamados.create'], 'uses' => 'UsersController@store'])->name('tipos-de-chamados.registrar');
        Route::get('/editar/{id}',['shield' => ['tipos-de-chamados.edit'], 'uses' => 'UsersController@edit'])->name('tipos-de-chamados.editar');
        Route::post('/editar/{id}',['shield' => ['tipos-de-chamados.edit'], 'uses' => 'UsersController@update'])->name('tipos-de-chamados.alterar');
        Route::delete('/{id}',['shield' => ['tipos-de-chamados.destroy'], 'uses' => 'UsersController@destroy'])->name('tipos-de-chamados.deletar');
    });

    include 'impactos/web.php';
    include 'status_ticket/web.php';

});