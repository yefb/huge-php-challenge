<?php namespace Challenge\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use StdClass;

class BucketFillCommand  extends BaseCommand
{
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $coord = new StdClass;
        $coord->xAxis = $input->getArgument('x');
        $coord->yAxis = $input->getArgument('y');
        $coord->color = $input->getArgument('color');

        $this->drawer->setCoords($coord);

        $this->currentDrawing = $this->drawer->generateDrawing();

        $this->drawer->doDraw($this->currentDrawing);
    }

}
