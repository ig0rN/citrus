<?php

$router->get('', 'PageController@home');

$router->post('comment', 'CommentsController@store');

$router->get('admin/login', 'Admin\AuthController@showLogin');
$router->post('admin', 'Admin\AuthController@login');
$router->get('admin/logout', 'Admin\AuthController@logout');

$router->get('admin', 'Admin\HomeController@redirect');
$router->get('admin/home', 'Admin\HomeController@index');

$router->get('admin/comments', 'Admin\CommentsController@showComments');
$router->post('admin/comment/approve', 'Admin\CommentsController@approve');
$router->post('admin/comment/delete', 'Admin\CommentsController@delete');