<?php namespace Challenge\Commands;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CanvasCommand
 * @package Challenge\Commands
 *
 * Command in charge of drawing a canvas
 *
 * Usage: C width height
 */
class CanvasCommand extends BaseCommand
{
    /**
     * Set the parameters to use when calling the command
     */
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

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     *
     * Execution of the command.
     * This method takes the sent width and height, then draws the canvas
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $width = $input->getArgument('width');
        $height = $input->getArgument('height');

        $this->drawer->setWidth($width);
        $this->drawer->setHeight($height);

        $this->drawer->doDraw($this->drawer->generateDrawing());
    }
}
