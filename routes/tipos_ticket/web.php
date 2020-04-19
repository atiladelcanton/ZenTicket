<?php

Route::prefix('tipos-de-chamados')->middleware('needsPermission')->group(function () {
    Route::get('/', ['shield' => ['tipos-de-chamados.index'], 'uses' => 'TypeTicketController@index'])->name('tipos-de-chamados');
    Route::get('/criar',['shield' => ['tipos-de-chamados.create'], 'uses' => 'TypeTicketController@create'])->name('tipos-de-chamados.create');
    Route::post('/criar',['shield' => ['tipos-de-chamados.create'], 'uses' => 'TypeTicketController@store'])->name('tipos-de-chamados.registrar');
    Route::get('/editar/{id}',['shield' => ['tipos-de-chamados.edit'], 'uses' => 'TypeTicketController@edit'])->name('tipos-de-chamados.editar');
    Route::post('/editar/{id}',['shield' => ['tipos-de-chamados.edit'], 'uses' => 'TypeTicketController@update'])->name('tipos-de-chamados.alterar');
    Route::delete('/{id}',['shield' => ['tipos-de-chamados.destroy'], 'uses' => 'TypeTicketController@destroy'])->name('tipos-de-chamados.deletar');
});