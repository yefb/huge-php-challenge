<?php namespace Challenge\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use StdClass;

/**
 * Class BucketFillCommand
 * @package Challenge\Commands
 *
 * Command used to simulate a bucket fill in to the canvas
 */
class BucketFillCommand  extends BaseCommand
{
    /**
     * Set the parameters to use when calling the command
     */
    protected function configure()
    {
        $this
            ->setName('b')
            ->setDescription('Draw a Line')
            ->addArgument(
                'x',
                InputArgument::REQUIRED,
                'x axis for the fill starting point'
            )
            ->addArgument(
                'y',
                InputArgument::REQUIRED,
                'y axis for the fill starting point'
            )
            ->addArgument(
                'color',
                InputArgument::REQUIRED,
                'color to use for filling the canvas'
            )
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     *
     * Execution of the command.
     * This method takes the sent coordinates and then calls it's drawer to
     * fill the canvas with the sent color
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $coord = new StdClass;
        $coord->xAxis = $input->getArgument('x');
        $coord->yAxis = $input->getArgument('y');
        $coord->color = $input->getArgument('color');

        $this->drawer->setCoords($coord);

        $this->drawer->doDraw($this->drawer->generateDrawing());
    }

}
