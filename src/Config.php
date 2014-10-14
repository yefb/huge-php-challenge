<?php namespace Challenge;

class Config
{
    public static function getDrawingStorageFile()
    {
        $file = dirname(__FILE__) . "/.drawing";

        return $file;
    }
}
