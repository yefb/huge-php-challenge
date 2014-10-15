<?php

use Challenge\Drawers\CanvasDrawer;

class BucketFillDrawerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->canvasDrawer = new CanvasDrawer();

        $this->mock = $this->getMock('Challenge\Drawers\BucketFillDrawer',
            [
                'validateCoords',
            ]);

        $this->createCanvas();
    }

    public function testFillAnArea()
    {
        $this->createCanvas();

        $c = new StdClass;
        $c->xAxis = 2;
        $c->yAxis = 2;
        $c->color = "T";

        $this->mock->setCoords($c);
        $canvas = $this->mock->generateDrawing();

        $this->assertEquals("T", $canvas[2][1]);
    }

    private function createCanvas()
    {
        $this->canvasDrawer->setWidth(10);
        $this->canvasDrawer->setHeight(5);

        $canvas = $this->canvasDrawer->createCanvas();
        $this->canvasDrawer->saveCurrentDrawing($canvas);

        return $canvas;
    }
}
