<?php namespace Challenge;

/**
 * Class Config
 * @package Challenge
 *
 * Main config class for the application.
 */
class Config
{
    /**
     * Get the current folder set for storing the drawing
     *
     * @return string
     */
    public static function getDrawingStorageFile()
    {
        $file = dirname(__FILE__) . "/storage/current_drawing";

        return $file;
    }
}
