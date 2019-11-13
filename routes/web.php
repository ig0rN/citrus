<?php

$router->get('', 'PageController@home');
$router->get('test', 'PageController@test');
$router->post('comment', 'CommentsController@store');