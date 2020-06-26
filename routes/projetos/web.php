<?php
    Route::prefix('projetos')->middleware('needsPermission')->group(function () {
        Route::get('/', ['shield' => ['projetos.index'], 'uses' => 'ProjectController@index'])->name('projetos');
        Route::get('/criar',['shield' => ['projetos.create'], 'uses' => 'ProjectController@create'])->name('projetos.create');
        Route::post('/criar',['shield' => ['projetos.create'], 'uses' => 'ProjectController@store'])->name('projetos.registrar');
        Route::get('/editar/{id}',['shield' => ['projetos.edit'], 'uses' => 'ProjectController@edit'])->name('projetos.editar');
        Route::post('/editar/{id}',['shield' => ['projetos.edit'], 'uses' => 'ProjectController@update'])->name('projetos.alterar');
        Route::delete('/{id}',['shield' => ['projetos.destroy'], 'uses' => 'ProjectController@destroy'])->name('projetos.deletar');
    });
