<?php
return [
    // Home
    'inicio' => 'HomeController@index',

    // Authentication
    'login'       => 'AuthController@index',
    'signup'      => 'AuthController@signup',
    'auth/login'  => 'AuthController@login',
    'auth/signup' => 'AuthController@register',
    'logout'      => 'AuthController@logout',
    'auth/reset-password' => 'AuthController@resetPassword',

    // Panel
    'panel'       => 'PanelController@index',

    // Users
    'usuarios'    => 'UserController@index',

    // Activities
    'actividades' => 'ActivitiesController@index',

    // API Routes
    'api/activities' => [
        'GET'    => 'ActivitiesController@getAll',
        'POST'   => 'ActivitiesController@create'
    ],
    'api/activities/upcoming' => [
        'GET'    => 'ActivitiesController@upcoming'
    ],
    'api/activities/:id' => [
        'GET'    => 'ActivitiesController@get',
        'PUT'    => 'ActivitiesController@update',
        'DELETE' => 'ActivitiesController@delete'
    ],

    // Testing / debugging
    'data'        => 'AuthController@getSessionData',
    'auth/security-questions' => 'AuthController@getSecurityQuestions',
];