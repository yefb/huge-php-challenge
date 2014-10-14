<?php
namespace Challenge\Drawers;


use Challenge\Config;

/**
 * Class BaseDrawer
 * @package Challenge\Drawers
 *
 * Parent Drawing class
 */
abstract class BaseDrawer
{
    /**
     * @var array
     *
     * The current drawing array (canvas with shapes)
     */
    protected $currentDrawing = null;

    /**
     * Vertical border char
     *
     * @var string
     */
    protected $verticalChar = "|";

    /**
     * @var string
     *
     * Horizontal border char
     */
    protected $horizontalChar = "-";

    /**
     * @var string
     *
     * Char to use when drawing a line
     */
    protected $lineChar = "X";

    /**
     * @var string
     *
     * Char to use for drawing an empty cell
     */
    protected $emptyChar = " ";

    /**
     * @var string
     *
     * Color to use when for some reason there is no color to use
     * in the fill
     */
    protected $defaultColor = "O";

    /**
     * @param array $drawing
     *
     * Draw the sent drawing (canvas with shapes) into the output
     */
    public function doDraw($drawing = [])
    {
        foreach ($drawing as $xPixel => $matrix) {

            foreach ($matrix as $yPixel => $value) {

                echo $drawing[$xPixel][$yPixel];
            }

            echo PHP_EOL;
        }

        // Save the current drawing into the storage file
        $this->saveCurrentDrawing($drawing);
    }

    /**
     * @param $drawing
     *
     * Save the current drawing into the storage file.
     * This serializes the drawing before saving it
     */
    public function saveCurrentDrawing($drawing)
    {
        $filename = Config::getDrawingStorageFile();
        $serializedDrawing = serialize($drawing);

        file_put_contents($filename, $serializedDrawing);
    }

    /**
     * @return mixed|null
     *
     * Get the serialized drawing from the storage file, unserialize it and
     * return it for its usage
     */
    public function loadCurrentDrawing()
    {
        $filename = Config::getDrawingStorageFile();

        if (!file_exists($filename)) {
            return null;
        }

        $serializedDrawing = file_get_contents($filename);

        return unserialize($serializedDrawing);
    }
}
