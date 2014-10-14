#!/usr/bin/env php
<?php
ini_set('memory_limit', '256M');

// Call the composer autoloader
require_once 'vendor/autoload.php';

// Load the site configs
require_once 'src/config.php';

use Challenge\Application;
use Symfony\Component\Console\Input\StringInput;

// Setup the application registering the commands to use
$app = new Application();
$app->registerCommands();
$app->setAutoExit(false);

$command = "";
// Start the application
while (!in_array($command, $app->exitCommands)) {

    $command = readline("Enter Command: ");
    $command = strtolower($command);

    if (in_array($command, $app->exitCommands) || empty($command)) {
        continue;
    }

    readline_add_history($command);

    try {
        $app->run(new StringInput($command));
    } catch (Exception $e) {
        // Do something
    }
}
