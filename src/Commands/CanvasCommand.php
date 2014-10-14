<?php namespace Challenge\Commands;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CanvasCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('c')
            ->setDescription('Draw a Canvas')
            ->addArgument(
                'width',
                InputArgument::REQUIRED,
                'Width of the canvas?'
            )
            ->addArgument(
                'height',
                InputArgument::REQUIRED,
                'Height of the canvas?'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $width = $input->getArgument('width');
        $height = $input->getArgument('height');

        $this->drawer->setWidth($width);
        $this->drawer->setHeight($height);

        $this->currentDrawing = $this->drawer->generateDrawing();

        $this->drawer->doDraw($this->currentDrawing);
    }
}
