<?php
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/config.php';

// https://symfony.com/doc/current/components/console/single_command_tool.html

use HeroGame\Command\StartGame;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new StartGame());
$application->run();
