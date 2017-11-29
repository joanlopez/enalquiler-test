<?php

namespace tests\unit;

use JL\EnAlquilerTest\Exceptions\InvalidOrientationException;
use JL\EnAlquilerTest\Rover;
use PHPUnit\Framework\TestCase;

class RoverPositionTest extends TestCase
{
    public function testGoForwardWhenSouthOrientation()
    {
        $rover = new Rover(1,1, 'S');
        $rover->move('M');
        self::assertEquals(1, $rover->x());
        self::assertEquals(0, $rover->y());
        self::assertEquals('S', $rover->orientation());
    }

    public function testGoForwardWhenNorthOrientation()
    {
        $rover = new Rover(1,1, 'N');
        $rover->move('M');
        self::assertEquals(1, $rover->x());
        self::assertEquals(2, $rover->y());
        self::assertEquals('N', $rover->orientation());
    }

    public function testGoForwardWhenEastOrientation()
    {
        $rover = new Rover(1,1, 'E');
        $rover->move('M');
        self::assertEquals(2, $rover->x());
        self::assertEquals(1, $rover->y());
        self::assertEquals('E', $rover->orientation());
    }

    public function testGoForwardWhenWestOrientation()
    {
        $rover = new Rover(1,1, 'W');
        $rover->move('M');
        self::assertEquals(0, $rover->x());
        self::assertEquals(1, $rover->y());
        self::assertEquals('W', $rover->orientation());
    }

    public function testRotateRightWhenSouthOrientation()
    {
        $rover = new Rover(1,1, 'S');
        $rover->move('R');
        self::assertEquals(1, $rover->x());
        self::assertEquals(1, $rover->y());
        self::assertEquals('W', $rover->orientation());
    }

    public function testRotateRightWhenNorthOrientation()
    {
        $rover = new Rover(1,1, 'N');
        $rover->move('R');
        self::assertEquals(1, $rover->x());
        self::assertEquals(1, $rover->y());
        self::assertEquals('E', $rover->orientation());
    }

    public function testRotateRightWhenEastOrientation()
    {
        $rover = new Rover(1,1, 'E');
        $rover->move('R');
        self::assertEquals(1, $rover->x());
        self::assertEquals(1, $rover->y());
        self::assertEquals('S', $rover->orientation());
    }

    public function testRotateRightWhenWestOrientation()
    {
        $rover = new Rover(1,1, 'W');
        $rover->move('R');
        self::assertEquals(1, $rover->x());
        self::assertEquals(1, $rover->y());
        self::assertEquals('N', $rover->orientation());
    }

    public function testRotateLeftWhenSouthOrientation()
    {
        $rover = new Rover(1,1, 'S');
        $rover->move('L');
        self::assertEquals(1, $rover->x());
        self::assertEquals(1, $rover->y());
        self::assertEquals('E', $rover->orientation());
    }

    public function testRotateLeftWhenNorthOrientation()
    {
        $rover = new Rover(1,1, 'N');
        $rover->move('L');
        self::assertEquals(1, $rover->x());
        self::assertEquals(1, $rover->y());
        self::assertEquals('W', $rover->orientation());
    }

    public function testRotateLeftWhenEastOrientation()
    {
        $rover = new Rover(1,1, 'E');
        $rover->move('L');
        self::assertEquals(1, $rover->x());
        self::assertEquals(1, $rover->y());
        self::assertEquals('N', $rover->orientation());
    }

    public function testRotateLeftWhenWestOrientation()
    {
        $rover = new Rover(1,1, 'W');
        $rover->move('L');
        self::assertEquals(1, $rover->x());
        self::assertEquals(1, $rover->y());
        self::assertEquals('S', $rover->orientation());
    }

    public function testRoverToStringReturnsExpectedString()
    {
        $rover = new Rover(1, 1, 'N');
        self::assertEquals('1 1 N', (string)$rover);
    }

    public function testInvalidCharOrientationThrowsException()
    {
        $this->expectException(InvalidOrientationException::class);
        new Rover(1,1,'C');
    }

    public function testInvalidStringOrientationThrowsException()
    {
        $this->expectException(InvalidOrientationException::class);
        new Rover(1,1,'WE');
    }

    public function testInvalidTypeOrientationThrowsException()
    {
        $this->expectException(InvalidOrientationException::class);
        new Rover(1,1,1);
    }
}