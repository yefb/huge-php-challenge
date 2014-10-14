<?php namespace Challenge;

class Config
{
    public static function getDrawingStorageFile()
    {
        $file = dirname(__FILE__) . "/storage/current_drawing";

        return $file;
    }
}
