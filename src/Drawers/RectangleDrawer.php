<?php namespace Challenge\Drawers;

/**
 * Class RectangleDrawer
 * @package Challenge\Drawers
 *
 * This class is in charge of drawing rectangles in the canvas
 */
class RectangleDrawer extends LineDrawer
    implements DrawerInterface
{
    /**
     * @return mixed|null
     *
     * Update the current drawing putting a rectangle on it
     */
    public function generateDrawing()
    {
        // Get the current drawing
        $this->currentDrawing = $this->loadCurrentDrawing();

        // Validate if the sent coordinates are correct
        $this->validateCoords();

        // First, draw two horizontal lines, one for the top and another for the
        // bottom part of the rectangle
        $this->drawHorizontalLine($this->startingY, $this->startingX, $this->endingX);
        $this->drawHorizontalLine($this->endingY, $this->startingX, $this->endingX);

        // Now, draw two vertical lines, one for the left and another one for
        // the right side
        $this->drawVerticalLine($this->startingX, $this->startingY, $this->endingY);
        $this->drawVerticalLine($this->endingX, $this->startingY, $this->endingY);


        return $this->currentDrawing;
    }

    /**
     * @throws \Exception
     *
     * Check whether the sent coordinates are valid.
     */
    protected function compareCoordValues()
    {
        // We can't draw in a negative way
        if ($this->startingX > $this->endingX) {
            throw new \Exception("Ending X Axis must be higher than the starting one");
        }

        // idem
        if ($this->startingY > $this->endingY) {
            throw new \Exception("Ending Y Axis must be higher than the starting one");
        }
    }
} 
