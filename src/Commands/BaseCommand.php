<?php namespace Challenge\Commands;

use Challenge\Drawers\DrawerInterface;

use Symfony\Component\Console\Command\Command;

/**
 * Class BaseCommand
 * @package Challenge\Commands
 *
 * Parent command class
 */
abstract class BaseCommand extends Command
{
    /**
     * @var DrawerInterface|null
     *
     * Each command knows how to draw itself, thanks to the drawer
     */
    protected $drawer = null;

    /**
     * @param DrawerInterface $drawer
     *
     * Injects the drawer, then calls the parent constructor
     */
    public function __construct(DrawerInterface $drawer)
    {
        $this->drawer = $drawer;

        parent::__construct();
    }
} 
