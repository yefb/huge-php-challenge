<?php namespace Challenge\Drawers;

class LineDrawer extends BaseDrawer
    implements DrawerInterface
{
    protected $startingX = 0;
    protected $startingY = 0;
    protected $endingX = 0;
    protected $endingY = 0;

    public function generateDrawing()
    {
        $this->currentDrawing = $this->loadCurrentDrawing();
        $this->validateCoords();

        if ($this->startingX == $this->endingX) {
            $this->drawVerticalLine($this->startingX, $this->startingY, $this->endingY);
        }

        if ($this->startingY == $this->endingY) {
            $this->drawHorizontalLine($this->startingY, $this->startingX, $this->endingX);
        }

        return $this->currentDrawing;
    }

    public function setCoords($coords)
    {
        // Adjust the coordinates as the drawing array is zero-based
        $this->startingX = $coords->startingX ?: 0;
        $this->startingY = $coords->startingY ?: 0;
        $this->endingX   = $coords->endingX ?: 0;
        $this->endingY   = $coords->endingY ?: 0;
    }

    protected function validateCoords()
    {

        $this->checkCoordsInsideBounds();
        $this->compareCoordValues();

        return true;
    }

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

    protected function drawHorizontalLine($yAxis, $startingX, $endingX)
    {
        foreach ($this->currentDrawing[$yAxis] as $index => $pixel) {
            if ($index >= $startingX && $index <= $endingX) {
                $this->currentDrawing[$yAxis][$index] = $this->lineChar;
            }
        }
    }

    protected function drawVerticalLine($xAxis, $startingY, $endingY)
    {
        for ($i = $startingY; $i <= $endingY; $i++) {
            $this->currentDrawing[$i][$xAxis] = $this->lineChar;
        }
    }
} 
