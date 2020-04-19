<?php
Route::prefix('impactos')->middleware('needsPermission')->group(function () {
    Route::get('/', ['shield' => ['impactos.index'], 'uses' => 'ImpactController@index'])->name('impactos');
    Route::get('/criar',['shield' => ['impactos.create'], 'uses' => 'ImpactController@create'])->name('impactos.create');
    Route::post('/criar',['shield' => ['impactos.create'], 'uses' => 'ImpactController@store'])->name('impactos.registrar');
    Route::get('/editar/{id}',['shield' => ['impactos.edit'], 'uses' => 'ImpactController@edit'])->name('impactos.editar');
    Route::post('/editar/{id}',['shield' => ['impactos.edit'], 'uses' => 'ImpactController@update'])->name('impactos.alterar');
    Route::delete('/{id}',['shield' => ['impactos.destroy'], 'uses' => 'ImpactController@destroy'])->name('impactos.deletar');
});