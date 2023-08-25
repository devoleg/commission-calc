<?php

use App\Command\AppCommand;
use Symfony\Component\Dotenv\Dotenv;
use App\Service\Config;

define('PATH', __DIR__);

require PATH . '/vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(PATH.'/.env');
Config::init(['app']);

$controller = new AppCommand();
$controller->run($argv[1]);