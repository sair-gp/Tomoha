<?php
return [
    // Home
    'inicio' => 'HomeController@index',

    // Authentication
    'login'       => 'AuthController@index',          // mostrar vista de inicio de sesión
    'signup'      => 'AuthController@signup',        // mostrar vista de registro de usuario
    'auth/login'  => 'AuthController@login',         // procesar inicio de sesión
    'logout'      => 'AuthController@logout',        // cerrar sesión

    // Panel
    'panel'       => 'PanelController@index',        // mostrar vista de panel principal

    // Testing / debugging
    'data'        => 'AuthController@getSessionData', 
];
