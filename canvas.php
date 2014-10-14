#!/usr/bin/env php
<?php
ini_set('memory_limit', '256M');

use Challenge\Application;
use Symfony\Component\Console\Input\StringInput;


// Call the composer autoloader
require_once 'vendor/autoload.php';

// Load the site configs
require_once 'src/config.php';

// Setup the application registering the commands to use and the storage folder
$app = new Application();
$app->checkOrCreateStorageFile();
$app->registerCommands();

// Do not close the app after every command
$app->setAutoExit(false);

$command = "";

// Listen for commands by the user
while (!in_array($command, $app->exitCommands)) {

    $command = readline("Enter Command: ");
    $command = strtolower($command);

    if (in_array($command, $app->exitCommands) || empty($command)) {
        echo "Bye!" . PHP_EOL;
        continue;
    }

    readline_add_history($command);

    try {
        $app->run(new StringInput($command));
    } catch (Exception $e) {
        // Do something
    }
}
