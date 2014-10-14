<?php
namespace Challenge\Drawers;


use Challenge\Config;

class BaseDrawer
{
    protected $currentDrawing = null;

    protected $verticalChar = "|";

    protected $horizontalChar = "-";

    protected $lineChar = "X";

    protected $emptyChar = " ";

    protected $defaultColor = "O";

    public function doDraw($drawing = [])
    {
        foreach ($drawing as $xPixel => $matrix) {

            foreach ($matrix as $yPixel => $value) {

                echo $drawing[$xPixel][$yPixel];
            }

            echo PHP_EOL;
        }

        $this->saveCurrentDrawing($drawing);
    }

    public function saveCurrentDrawing($drawing)
    {
        $filename = Config::getDrawingStorageFile();
        $serializedDrawing = serialize($drawing);

        file_put_contents($filename, $serializedDrawing);
    }

    public function loadCurrentDrawing()
    {
        $filename = Config::getDrawingStorageFile();

        if (!file_exists($filename)) {
            touch($filename);

            return null;
        }

        $serializedDrawing = file_get_contents($filename);

        return unserialize($serializedDrawing);
    }
}
