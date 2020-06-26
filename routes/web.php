<?php

    Route::get(
        '/',
        function () {
            return redirect('/login');
        }
    );

    Auth::routes(['verify' => true]);

    Route::get('/home', 'HomeController@index')->name('home');


    include 'grupos/web.php';
    include 'usuarios/web.php';
    include 'chamados/web.php';
    include 'projetos/web.php';
    Route::group(
        ['configuacoes', 'prefix' => 'configuracoes'],
        function () {
            include 'prioridade/web.php';
            include 'tipos_ticket/web.php';
            include 'impactos/web.php';
            include 'status_ticket/web.php';
        }
    );



