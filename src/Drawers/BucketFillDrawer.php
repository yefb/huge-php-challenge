<?php namespace Challenge\Drawers;

class BucketFillDrawer extends LineDrawer
    implements DrawerInterface
{
    protected $xAxis;

    protected $yAxis;

    protected $color;

    protected $colorToReplace;

    public function setCoords($coords)
    {
        $this->xAxis = $coords->xAxis ?: 0;
        $this->yAxis = $coords->yAxis ?: 0;
        $this->color = $coords->color ?: $this->defaultColor;
        $this->colorToReplace = $this->emptyChar;
    }

    public function generateDrawing()
    {
        $this->currentDrawing = $this->loadCurrentDrawing();
        $this->validateCoord();

        $this->searchAndFillCoords($this->xAxis, $this->yAxis);

        return $this->currentDrawing;
    }

    protected function validateCoord()
    {
        $this->checkCoordsInsideBounds();

        if ($this->color == $this->verticalChar || $this->color == $this->horizontalChar) {
            throw new \Exception("Invalid fill color");
        }

        $coordValue = $this->currentDrawing[$this->yAxis][$this->xAxis];

        if ($coordValue != $this->colorToReplace) {
            $this->colorToReplace = $coordValue;
        }
    }

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

//        print_r([$xAxis, $yAxis, $this->currentDrawing[$currentYAxis][$currentXAxis]]);
    }
}
