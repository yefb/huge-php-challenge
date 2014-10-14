<?php namespace Challenge\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use StdClass;

/**
 * Class LineCommand
 * @package Challenge\Commands
 *
 * Command in charge of drawing lines in the canvas
 *
 * Usage: L x1 y1 x2 y2
 */
class LineCommand extends BaseCommand
{
    /**
     * Set the parameters/settings for the command
     */
    protected function configure()
    {
        $this
            ->setName('l')
            ->setDescription('Draw a Line')
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

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     *
     * Execution of the command.
     * This takes the sent parameters, sets the coordinates and draws the shape
     * in to the canvas
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $coord = new StdClass;
        $coord->startingX = $input->getArgument('x1');
        $coord->startingY = $input->getArgument('y1');
        $coord->endingX   = $input->getArgument('x2');
        $coord->endingY   = $input->getArgument('y2');

        $this->drawer->setCoords($coord);

        $this->drawer->doDraw($this->drawer->generateDrawing());
    }

} 
