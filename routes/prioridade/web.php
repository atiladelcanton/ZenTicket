<?php

Route::prefix('prioridade')->middleware('needsPermission')->group(function () {
    Route::get('/', ['shield' => ['prioridade.index'], 'uses' => 'PriorityController@index'])->name('prioridade');
    Route::get('/criar',['shield' => ['prioridade.create'], 'uses' => 'PriorityController@create'])->name('prioridade.create');
    Route::post('/criar',['shield' => ['prioridade.create'], 'uses' => 'PriorityController@store'])->name('prioridade.registrar');
    Route::get('/editar/{id}',['shield' => ['prioridade.edit'], 'uses' => 'PriorityController@edit'])->name('prioridade.editar');
    Route::post('/editar/{id}',['shield' => ['prioridade.edit'], 'uses' => 'PriorityController@update'])->name('prioridade.alterar');
    Route::delete('/{id}',['shield' => ['prioridade.destroy'], 'uses' => 'PriorityController@destroy'])->name('prioridade.deletar');
});