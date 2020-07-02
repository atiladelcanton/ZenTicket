<?php
Route::prefix('usuarios')->middleware('needsPermission')->group(function () {
    Route::get('/', ['shield' => ['usuarios.index'], 'uses' => 'UsersController@index'])->name('usuarios');
    Route::get('/criar', ['shield' => ['usuarios.create'], 'uses' => 'UsersController@create'])->name('usuarios.create');
    Route::post('/criar', ['shield' => ['usuarios.create'], 'uses' => 'UsersController@store'])->name('usuarios.registrar');
    Route::get('/editar/{id}', ['shield' => ['usuarios.edit'], 'uses' => 'UsersController@edit'])->name('usuarios.editar');
    Route::post('/editar/{id}', ['shield' => ['usuarios.edit'], 'uses' => 'UsersController@update'])->name('usuarios.alterar');

    Route::delete('/{id}', ['shield' => ['usuarios.destroy'], 'uses' => 'UsersController@destroy'])->name('usuarios.deletar');
});
