<?php namespace Challenge\Drawers;

class RectangleDrawer extends LineDrawer
    implements DrawerInterface
{
    public function generateDrawing()
    {
        $this->currentDrawing = $this->loadCurrentDrawing();
        $this->validateCoords();

        $this->drawHorizontalLine($this->startingY, $this->startingX, $this->endingX);
        $this->drawHorizontalLine($this->endingY, $this->startingX, $this->endingX);
        $this->drawVerticalLine($this->startingX, $this->startingY, $this->endingY);
        $this->drawVerticalLine($this->endingX, $this->startingY, $this->endingY);


        return $this->currentDrawing;
    }

    protected function compareCoordValues()
    {
        if ($this->startingX > $this->endingX) {
            throw new \Exception("Ending X Axis must be higher than the starting one");
        }

        if ($this->startingY > $this->endingY) {
            throw new \Exception("Ending Y Axis must be higher than the starting one");
        }
    }
} 
