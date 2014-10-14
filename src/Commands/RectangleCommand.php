<?php namespace Challenge\Commands;

use Symfony\Component\Console\Input\InputArgument;

class RectangleCommand extends LineCommand
{
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
