<?php

define("ROOT_DIR", __DIR__);

require_once 'bootstrap/bootstrap.php';

use Core\{Router, Request};

Router::load('routes/web.php')
    ->direct(Request::uri(), Request::method());