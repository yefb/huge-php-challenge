<?php namespace Challenge\Commands;

use Challenge\Drawers\DrawerInterface;

use Symfony\Component\Console\Command\Command;

class BaseCommand extends Command
{
    protected $drawer = null;

    protected $currentDrawing = null;

    public function __construct(DrawerInterface $drawer)
    {
        $this->drawer = $drawer;

        parent::__construct();
    }
} 
