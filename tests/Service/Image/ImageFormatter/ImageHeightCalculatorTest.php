<?php

namespace App\Tests\Service\Image\ImageFormatter;

use App\Service\Image\ImageFormatter\ImageHeightCalculator;
use PHPUnit\Framework\TestCase;

class ImageHeightCalculatorTest extends TestCase
{
    public function testIfWidthCalculatedCorrectly(): void
    {
        $calculator = new ImageHeightCalculator();

        $expectedWidth = 75;

        $this->assertEquals($expectedWidth, $calculator->calculateWidth(1600, 800, 150));
        $this->assertEquals(1600 / 800, 150 / 75);

        $expectedWidth = 300;

        $this->assertEquals($expectedWidth, $calculator->calculateWidth(800, 1600, 150));
        $this->assertEquals(800 / 1600, 150 / 300);
    }
}
