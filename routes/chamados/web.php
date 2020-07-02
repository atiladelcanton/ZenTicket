<?php

Route::prefix('chamados')->middleware('needsPermission')->group(
    function () {
        Route::get('/', ['shield' => ['chamados.index'], 'uses' => 'TicketController@index'])->name('chamados');
        Route::get('/criar', ['shield' => ['chamados.create'], 'uses' => 'TicketController@create'])->name(
            'chamados.create'
        );
        Route::post('/criar', ['shield' => ['chamados.create'], 'uses' => 'TicketController@store'])->name(
            'chamados.registrar'
        );
        Route::get('/{ticket_number}', ['shield' => ['chamados.edit'], 'uses' => 'TicketController@detail'])->name(
            'chamados.detail'
        );
        Route::get('/editar/{id}', ['shield' => ['chamados.edit'], 'uses' => 'TicketController@edit'])->name(
            'chamados.editar'
        );
        Route::post('/editar/{id}', ['shield' => ['chamados.edit'], 'uses' => 'TicketController@update'])->name(
            'chamados.alterar'
        );
        Route::post('evidences', ['shield' => ['chamados.create'], 'uses' => 'TicketController@upload'])->name(
            'chamados.registrar-evidencias'
        );
        Route::delete('/{id}', ['shield' => ['chamados.destroy'], 'uses' => 'TicketController@destroy'])->name(
            'chamados.deletar'
        );

        Route::post('/criar-ocorrencia', ['shield' => ['chamados.create'], 'uses' => 'TicketController@storeOccurence'])->name(
            'chamados.registrar-ocorrencia'
        );


        Route::post('/actions', ['shield' => ['chamados.create'], 'uses' => 'TicketController@storeActions'])->name(
            'chamados.registrar-actions'
        );

        Route::get('/arquivos/{ticket_number}', ['shield' => ['chamados.edit'], 'uses' => 'TicketController@getArchives'])->name(
            'chamados.arquivos'
        );
    }
);
