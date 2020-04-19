<?php

Route::prefix('status-ticket')->middleware('needsPermission')->group(function () {
    Route::get('/', ['shield' => ['status-ticket.index'], 'uses' => 'StatusTicketController@index'])->name('status-ticket');
    Route::get('/criar',['shield' => ['status-ticket.create'], 'uses' => 'StatusTicketController@create'])->name('status-ticket.create');
    Route::post('/criar',['shield' => ['status-ticket.create'], 'uses' => 'StatusTicketController@store'])->name('status-ticket.registrar');
    Route::get('/editar/{id}',['shield' => ['status-ticket.edit'], 'uses' => 'StatusTicketController@edit'])->name('status-ticket.editar');
    Route::post('/editar/{id}',['shield' => ['status-ticket.edit'], 'uses' => 'StatusTicketController@update'])->name('status-ticket.alterar');
    Route::delete('/{id}',['shield' => ['status-ticket.destroy'], 'uses' => 'StatusTicketController@destroy'])->name('status-ticket.deletar');
});