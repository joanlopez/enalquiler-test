<?php

namespace tests\integration;

use JL\EnAlquilerTest\Exceptions\InvalidMovementException;
use JL\EnAlquilerTest\Exceptions\RoverOutOfBoundsException;
use JL\EnAlquilerTest\Plateau;
use JL\EnAlquilerTest\Rover;
use PHPUnit\Framework\TestCase;

class PlateauTest extends TestCase
{
    private $plateau;

    public function setUp()
    {
        $this->plateau = new Plateau(1, 1);
        $this->plateau->addRover(new Rover(0, 0, 'N'));
        $this->plateau->addRover(new Rover(1, 1, 'S'));
    }

    public function testEmptyPlateauToStringReturnsExpectedString()
    {
        $grid = new Plateau(1, 1);
        self::assertEquals('', (string)$grid);
    }

    public function testNotEmptyPlateauToStringReturnsExpectedString()
    {
        self::assertEquals("0 0 N\n1 1 S\n", (string)$this->plateau);
    }

    public function testAddingAnOutOfBoundsRoverThrowsException()
    {
        $this->expectException(RoverOutOfBoundsException::class);
        $this->plateau->addRover(new Rover(2, 2, 'N'));
    }

    public function testMovingNotPresentRoverThrowsException()
    {
        $this->expectException(InvalidMovementException::class);
        $this->plateau->moveRover('MM', new Rover(1,1,'N'));
    }

    public function testMovingARoverToOutOfBoundsThrowsException()
    {
        $this->expectException(InvalidMovementException::class);
        $this->plateau->moveRover('MMM');
    }

    public function testWhenGivenAnInvalidMovementsListThenThrowsException()
    {
        $this->expectException(InvalidMovementException::class);
        $this->plateau->moveRover('DUMMY');
    }

    public function testWithTwoRoversAndSomeMovementsWorksAsExpected()
    {
        $plateau = new Plateau(5, 5);
        $plateau->addRover(new Rover(1, 2, 'N'));
        $plateau->moveRover('LMLMLMLMM');
        $plateau->addRover(new Rover(3, 3, 'E'));
        $plateau->moveRover('MMRMMRMRRM');
        self::assertEquals("1 3 N\n5 1 E\n", (string)$plateau);
    }
}