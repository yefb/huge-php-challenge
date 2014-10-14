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

class Application extends BaseApplication
{
    public $exitCommands = [
        'q', 'exit', 'quit'
    ];

    public function registerCommands()
    {
        $this->add(new CanvasCommand(new CanvasDrawer()));
        $this->add(new LineCommand(new LineDrawer()));
        $this->add(new RectangleCommand(new RectangleDrawer()));
        $this->add(new BucketFillCommand(new BucketFillDrawer()));
    }
} 
