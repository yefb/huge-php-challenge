<?php namespace Challenge\Drawers;

class CanvasDrawer extends BaseDrawer
    implements DrawerInterface
{
    private $height = 0;

    private $width = 0;

    public function generateDrawing()
    {
        $this->currentDrawing = $this->createCanvas();

        return $this->currentDrawing;
    }

    public function createCanvas()
    {
        $matrix = [];

        for ($y = 0; $y < $this->height; $y++) {

            $matrix[$y] = [];

            for ($x = 0; $x < $this->width; $x++) {

                if ($y == 0 || $y == $this->height -1) {
                    $matrix[$y][$x] = $this->horizontalChar;
                } else if ($x == 0 || $x == $this->width -1) {
                    $matrix[$y][$x] = $this->verticalChar;
                } else {
                    $matrix[$y][$x] = $this->emptyChar;
                }
            }
        }

        return $matrix;
    }

    public function setWidth($width)
    {
        $this->width = $width + 2;
    }

    public function setHeight($height)
    {
        $this->height = $height + 2;
    }
} 
