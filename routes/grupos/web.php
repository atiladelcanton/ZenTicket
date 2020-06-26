<?php
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
