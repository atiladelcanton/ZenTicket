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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
