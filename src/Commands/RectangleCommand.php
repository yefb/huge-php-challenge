<?php namespace Challenge\Commands;

use Symfony\Component\Console\Input\InputArgument;

/**
 * Class RectangleCommand
 * @package Challenge\Commands
 *
 * Command in charge of drawing rectangles
 *
 * Usage: R x1 y1 x2 y2
 */
class RectangleCommand extends LineCommand
{
    /**
     * Set the parameters to use when calling the command
     */
    protected function configure()
    {
        $this
            ->setName('r')
            ->setDescription('Draw a Rectangle')
            ->addArgument(
                'x1',
                InputArgument::REQUIRED,
                'x of the start point'
            )
            ->addArgument(
                'y1',
                InputArgument::REQUIRED,
                'y of the start point'
            )
            ->addArgument(
                'x2',
                InputArgument::REQUIRED,
                'x of the end point'
            )
            ->addArgument(
                'y2',
                InputArgument::REQUIRED,
                'y of the end point'
            )
        ;
    }
}
