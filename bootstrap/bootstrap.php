<?php

require_once ROOT_DIR . '/vendor/autoload.php';

use Core\App;
use Core\Session;

App::bind('database', require_once 'config/database.php');

App::bind('session', new Session());