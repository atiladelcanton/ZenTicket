<?php
    Route::group(
        ['configuacoes', 'prefix' => 'configuracoes'],
        function () {
            include '../prioridade/web.php';
            include '../tipos_ticket/web.php';
            include '../impactos/web.php';
            include '../status_ticket/web.php';
        }
    );
