<?php namespace Challenge\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use StdClass;

class LineCommand extends BaseCommand
{
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $coord = new StdClass;
        $coord->startingX = $input->getArgument('x1');
        $coord->startingY = $input->getArgument('y1');
        $coord->endingX   = $input->getArgument('x2');
        $coord->endingY   = $input->getArgument('y2');

        $this->drawer->setCoords($coord);

        $this->currentDrawing = $this->drawer->generateDrawing();

        $this->drawer->doDraw($this->currentDrawing);
    }

} 
