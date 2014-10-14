<?php namespace Challenge\Drawers;

/**
 * Class BucketFillDrawer
 * @package Challenge\Drawers
 *
 * This class simulates a bucket fill in the canvas
 */
class BucketFillDrawer extends LineDrawer
    implements DrawerInterface
{
    /*
     * @var int
     *
     * X axis when the filling will start
     */
    protected $xAxis;

    /*
    * @var int
    *
    * Y axis when the filling will start
    */
    protected $yAxis;

    /*
     * @var mixed
     *
     * Color to use for the filling, it could be almost any char
     */
    protected $color;

    /*
     * The color that will be replaced by the fill
     */
    protected $colorToReplace;

    /**
     * @param $coords
     *
     * Sets the coordinates for the filling.
     * It also sets the color and replace color properties
     */
    public function setCoords($coords)
    {
        $this->xAxis = $coords->xAxis ?: 0;
        $this->yAxis = $coords->yAxis ?: 0;
        $this->color = $coords->color ?: $this->defaultColor;
        $this->colorToReplace = $this->emptyChar;
    }

    /**
     * @return mixed|null
     * @throws \Exception
     *
     * Update the current drawing filling the adjacent parts of the coordinates
     * with the sent color
     */
    public function generateDrawing()
    {
        // Get the current drawing
        $this->currentDrawing = $this->loadCurrentDrawing();

        // Validate if the coordinates are valid
        $this->validateCoord();

        // Navigate thru the canvas and fill with the color
        $this->searchAndFillCoords($this->xAxis, $this->yAxis);

        return $this->currentDrawing;
    }

    /**
     * @throws \Exception
     *
     * Checks whether the sent coordinate does exist.
     * Sanity checks the fill and replace colors
     */
    protected function validateCoord()
    {
        $this->checkCoordsInsideBounds();

        // You cant use one of the border chars as a fill color
        if ($this->color == $this->verticalChar || $this->color == $this->horizontalChar) {
            throw new \Exception("Invalid fill color");
        }

        // Get the current value in the sent coordinates
        $coordValue = $this->currentDrawing[$this->yAxis][$this->xAxis];

        // Make the color to replace the same as the one the current coordinate has
        if ($coordValue != $this->colorToReplace) {
            $this->colorToReplace = $coordValue;
        }
    }

    /*
     * Validate if the coordinates are inside the canvas
     */
    protected function checkCoordsInsideBounds()
    {
        if (!isset($this->currentDrawing[$this->yAxis])) {
            $message = "Starting Y Axis";
        } else if (!isset($this->currentDrawing[$this->yAxis][$this->xAxis])) {
            $message = "Starting X Axis";
        }

        if (isset($message)) {
            $message .= " out of bounds or canvas not set (c w h)";
            throw new \Exception($message);
        }

        return true;
    }

    /**
     * @param $xAxis
     * @param $yAxis
     *
     * Navigate thru the canvas to fill the adjacent cells with the sent colors.
     *
     * This method searchs by north, south, east and west for cells with the same
     * color as the current one, if it does find any, then it fills it with the
     * new color and recursively looks for another cells
     *
     * @TODO: Fix the repeated code in the method
     */
    private function searchAndFillCoords($xAxis, $yAxis)
    {
        // Search up
        $currentXAxis = $xAxis;
        $currentYAxis = $yAxis - 1;

        if ($this->currentDrawing[$currentYAxis][$currentXAxis] == $this->colorToReplace) {
            $this->currentDrawing[$currentYAxis][$currentXAxis] = $this->color;
            $this->searchAndFillCoords($currentXAxis, $currentYAxis);
        }

        // Search down
        $currentXAxis = $xAxis;
        $currentYAxis = $yAxis + 1;
        if ($this->currentDrawing[$currentYAxis][$currentXAxis] == $this->colorToReplace) {
            $this->currentDrawing[$currentYAxis][$currentXAxis] = $this->color;
            $this->searchAndFillCoords($currentXAxis, $currentYAxis);
        }

        // Search left
        $currentXAxis = $xAxis - 1;
        $currentYAxis = $yAxis;
        if ($this->currentDrawing[$currentYAxis][$currentXAxis] == $this->colorToReplace) {
            $this->currentDrawing[$currentYAxis][$currentXAxis] = $this->color;
            $this->searchAndFillCoords($currentXAxis, $currentYAxis);
        }

        // Search right
        $currentXAxis = $xAxis + 1;
        $currentYAxis = $yAxis;
        if ($this->currentDrawing[$currentYAxis][$currentXAxis] == $this->colorToReplace) {
            $this->currentDrawing[$currentYAxis][$currentXAxis] = $this->color;
            $this->searchAndFillCoords($currentXAxis, $currentYAxis);
        }
    }
}
