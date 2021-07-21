<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Importable
    |--------------------------------------------------------------------------
    |
    | Variaveis de Ambiente responsaveis pela importacao de dataset.
    |
    */

    'users' => [
        'base_uri' => env('USERS_IMPORTABLE_URI', 'https://randomuser.me'),
        'timeout' => env('USERS_IMPORTABLE_TIMEOUT', 10)
    ]

];
