<?php namespace Challenge\Drawers;

/**
 * Class CanvasDrawer
 * @package Challenge\Drawers
 *
 * This class is in charge of drawing the canvas
 */
class CanvasDrawer extends BaseDrawer
    implements DrawerInterface
{
    /**
     * @var int
     *
     * Height of the canvas
     */
    private $height = 0;

    /**
     * @var int
     *
     * Width of the canvas
     */
    private $width = 0;

    /**
     * @return array
     *
     * Generate the canvas and return it
     */
    public function generateDrawing()
    {
        // Create the initial canvas
        $this->currentDrawing = $this->createCanvas();

        return $this->currentDrawing;
    }

    /*
     * Create the canvas based on the sent size
     *
     * It follows a backwards approach, so the X axis belongs to the Y axis
     * and not the opposite. This is an easier approach for filling the cells
     *
     * @return Array
     */
    public function createCanvas()
    {
        $matrix = [];

        for ($y = 0; $y < $this->height; $y++) {

            $matrix[$y] = [];

            for ($x = 0; $x < $this->width; $x++) {

                // If it is the first or the last Y cell, then put it
                // the horizontal border char
                if ($y == 0 || $y == $this->height -1) {
                    $matrix[$y][$x] = $this->horizontalChar;

                // If it is the first or the last X cell, then put it
                // the vertical border char
                } else if ($x == 0 || $x == $this->width -1) {
                    $matrix[$y][$x] = $this->verticalChar;

                // If it does not have any of the border chars, then put it
                // an empty one
                } else {
                    $matrix[$y][$x] = $this->emptyChar;
                }
            }
        }

        return $matrix;
    }

    /**
     * @param $width
     *
     * Setter for the width property
     * It allocates two more cells for the borders
     */
    public function setWidth($width)
    {
        $this->width = $width + 2;
    }

    /*
     * @param $height
     *
     * Setter for the height property
     * It allocates two more cells for the borders
     */
    public function setHeight($height)
    {
        $this->height = $height + 2;
    }
} 
