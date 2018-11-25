<?php

$route = app()->get('route');

// users routes
$route->add('/login', 'UserController@login', 'POST');
$route->add('/logout', 'UserController@logout', 'GET', ['Auth']);
$route->add('/register', 'UserController@create', 'POST');


// products routes
$route->add('/', 'ProductController@index', 'GET', ['Auth', 'Throttling']);
$route->add('/products', 'ProductController@index', 'GET', ['Auth', 'Throttling']);
$route->add('/products/{id}', 'ProductController@show', 'GET', ['Auth', 'Throttling']);
$route->add('/products', 'ProductController@store', 'POST', ['Auth', 'Throttling']);
$route->add('/products/{id}', 'ProductController@update', 'PUT', ['Auth', 'Throttling']);
$route->add('/products/{id}', 'ProductController@delete', 'DELETE', ['Auth', 'Throttling']);

