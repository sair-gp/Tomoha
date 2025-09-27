<?php
return [
    // Home
    'inicio' => 'HomeController@index',

    // Authentication
    'login'       => 'AuthController@index',          // mostrar vista de inicio de sesión
    'signup'      => 'AuthController@signup',        // mostrar vista de registro de usuario
    'auth/login'  => 'AuthController@login',         // procesar inicio de sesión
    'auth/signup' => 'AuthController@register',      // procesar registro de usuario
    'logout'      => 'AuthController@logout',        // cerrar sesión
    'auth/reset-password' => 'AuthController@resetPassword', // procesar recuperación de contraseña

    // Panel
    'panel'       => 'PanelController@index',        // mostrar vista de panel principal

    // Users
    'usuarios'    => 'UserController@index',         // mostrar vista de gestión de usuarios

    // Activities
    'actividades' => 'ActivitiesController@index',   // mostrar vista de gestión de actividades
    'api/activities' => 'ActivitiesController@get',   // obtener lista de actividades
    'api/activities/upcoming' => 'ActivitiesController@upcoming', // obtener próximas actividades

    // Testing / debugging
    'data'        => 'AuthController@getSessionData',
    'auth/security-questions' => 'AuthController@getSecurityQuestions',
    'api/users' => 'UserController@getAllUsers',
];
