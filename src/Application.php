<?php namespace Challenge;

use Symfony\Component\Console\Application as BaseApplication;

use Challenge\Commands\CanvasCommand;
use Challenge\Commands\LineCommand;
use Challenge\Commands\RectangleCommand;
use Challenge\Commands\BucketFillCommand;

use Challenge\Drawers\CanvasDrawer;
use Challenge\Drawers\LineDrawer;
use Challenge\Drawers\RectangleDrawer;
use Challenge\Drawers\BucketFillDrawer;

/**
 * Class Application
 * @package Challenge
 *
 * Application setup class.
 */
class Application extends BaseApplication
{
    /**
     * @var array
     *
     * When the user enters one of these commands, it will be considered
     * as an exit command
     */
    public $exitCommands = [
        'q', 'exit', 'quit'
    ];

    /**
     * Register all the available commands into the app
     */
    public function registerCommands()
    {
        $this->add(new CanvasCommand(new CanvasDrawer()));
        $this->add(new LineCommand(new LineDrawer()));
        $this->add(new RectangleCommand(new RectangleDrawer()));
        $this->add(new BucketFillCommand(new BucketFillDrawer()));
    }

    /**
     * @throws \Exception if the file cannot be written
     *
     * Check if the current drawing file exists
     * -> If it does not exist, the create it
     * -> If it does exist, then empty it
     */
    public function checkOrCreateStorageFile()
    {
        $storageFile = Config::getDrawingStorageFile();

        if (!file_exists($storageFile)) {

            if(!touch($storageFile)){
                throw new \Exception('Could not create storage file. Does the storage folder have writing permissions?');
            }
        } else {
            if (file_put_contents($storageFile, "") === false) {
                throw new \Exception('Could not reset the storage file. Does it have writing permissions?');
            }
        }
    }
} 
