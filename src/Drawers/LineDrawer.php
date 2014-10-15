<?php namespace Challenge\Drawers;

/**
 * Class LineDrawer
 * @package Challenge\Drawers
 *
 * This class is in charge of drawing lines on the canvas
 */
class LineDrawer extends BaseDrawer
    implements DrawerInterface
{

    /*
     * The starting X axis for the line
     *
     * @var int
     */
    protected $startingX = 0;

    /*
     * The starting Y axis for the line
     *
     * @var int
     */
    protected $startingY = 0;

    /*
     * The ending X axis for the line
     *
     * @var int
     */
    protected $endingX = 0;

    /*
     * The ending Y axis for the line
     *
     * @var int
     */
    protected $endingY = 0;

    /**
     * @return mixed|null
     *
     * Update the current drawing putting a line on it
     */
    public function generateDrawing()
    {
        // Get the current drawing
        $this->currentDrawing = $this->loadCurrentDrawing();

        // Validate if the coordinates are correct
        $this->validateCoords();

        // If the the start and end X axis are the same, then draw a vertical line
        if ($this->startingX == $this->endingX) {
            $this->drawVerticalLine($this->startingX, $this->startingY, $this->endingY);
        }

        // If the start and end Y axis are the same, then draw an horizontal line
        if ($this->startingY == $this->endingY) {
            $this->drawHorizontalLine($this->startingY, $this->startingX, $this->endingX);
        }

        return $this->currentDrawing;
    }

    /**
     * @param $coords
     *
     * Set the coordinate properties for the class
     */
    public function setCoords($coords)
    {
        // Adjust the coordinates as the drawing array is zero-based
        $this->startingX = $coords->startingX ?: 0;
        $this->startingY = $coords->startingY ?: 0;
        $this->endingX   = $coords->endingX ?: 0;
        $this->endingY   = $coords->endingY ?: 0;
    }

    /**
     * @return bool
     * @throws \Exception
     *
     * Validate if the sent coordinates are correct
     */
    protected function validateCoords()
    {
        $this->checkCoordsInsideBounds();
        $this->compareCoordValues();

        return true;
    }

    /**
     * @return bool
     * @throws \Exception
     *
     * Checks whether the sent coordinates are within the canvas bounds
     */
    protected function checkCoordsInsideBounds()
    {
        if (!isset($this->currentDrawing[$this->startingY])) {
            $message = "Starting Y Axis";
        } else if (!isset($this->currentDrawing[$this->startingY][$this->startingX])) {
            $message = "Starting X Axis";
        } else if (!isset($this->currentDrawing[$this->endingY])) {
            $message = "Ending Y Axis";
        } else if (!isset($this->currentDrawing[$this->endingY][$this->endingX])) {
            $message = "Ending X Axis";
        }

        if (isset($message)) {
            $message .= " out of bounds or canvas not set (c w h)";
            throw new \Exception($message);
        }

        return true;
    }

    /**
     * @throws \Exception
     *
     * Sanity check for the coordinates.
     */
    protected function compareCoordValues()
    {
        if ($this->startingX > $this->endingX) {
            throw new \Exception("Ending X Axis must be higher than the starting one");
        }

        if ($this->startingY > $this->endingY) {
            throw new \Exception("Ending Y Axis must be higher than the starting one");
        }

        if ($this->startingX != $this->endingX && $this->startingY != $this->endingY) {
            throw new \Exception("Vertical lines are currently not supported");
        }
    }

    /**
     * @param $yAxis
     * @param $startingX
     * @param $endingX
     *
     * Draw an horizontal line in the canvas
     * The line starts in the coordinates ($startingX, $yAxis)
     * ant ends in ($endingY, $yAxis)
     */
    public function drawHorizontalLine($yAxis, $startingX, $endingX)
    {
        foreach ($this->currentDrawing[$yAxis] as $index => $pixel) {
            if ($index >= $startingX && $index <= $endingX) {
                $this->currentDrawing[$yAxis][$index] = $this->lineChar;
            }
        }
    }

    /**
     * @param $xAxis
     * @param $startingY
     * @param $endingY
     *
     * Draw a vertical line in the canvas.
     * The line starts in the coordinates ($xAxis, $startingY)
     * ant ends in ($xAxis, $endingY)
     */
    public function drawVerticalLine($xAxis, $startingY, $endingY)
    {
        for ($i = $startingY; $i <= $endingY; $i++) {
            $this->currentDrawing[$i][$xAxis] = $this->lineChar;
        }
    }
} 
