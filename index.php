<?php

include __DIR__ . '/vendor/autoload.php';

use Classes\App;
use Classes\SessionControl;
use Classes\TokenControl;
use Model\Model;

header("Content-Type: application/json");

error_reporting( E_ALL & ~E_WARNING);


(new App($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'])) -> run();