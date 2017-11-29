<?php

namespace JL\EnAlquilerTest;

use JL\EnAlquilerTest\Exceptions\InvalidMovementException;
use JL\EnAlquilerTest\Exceptions\RoverOutOfBoundsException;

class Plateau
{
    private $upperX;
    private $upperY;
    private $lowerX;
    private $lowerY;
    private $rovers = [];

    public function __construct($upperX, $upperY, $lowerX=0, $lowerY=0)
    {
        $this->upperX = $upperX;
        $this->upperY = $upperY;
        $this->lowerX = $lowerX;
        $this->lowerY = $lowerY;
    }

    public function addRover(Rover $rover)
    {
        if(!$this->inBounds($rover->x(), $rover->y()))
            throw new RoverOutOfBoundsException('You\'re trying to add a rover out of bounds');
        array_push($this->rovers, $rover);
    }

    public function moveRover($movements, Rover $rover=null)
    {
        $rover = (is_null($rover)) ? end($this->rovers) : $rover;
        if(!in_array($rover, $this->rovers))
            throw new InvalidMovementException('You\'re trying to move a rover not present in the given plateau');
        if(!is_string($movements))
            throw new InvalidMovementException('You\re trying to follow an invalid list of movements');

        foreach (str_split($movements) as $move)
        {
            $rover->move($move);
            if(!$this->inBounds($rover->x(), $rover->y()))
                throw new InvalidMovementException('You moved a rover to out of bounds');
        }
    }

    public function __toString()
    {
        $output = '';
        foreach ($this->rovers as $rover) {
            $output .= (string)$rover . "\n";
        }
        return $output;
    }

    private function inBounds($x, $y)
    {
        return ($x >= $this->lowerX && $x <= $this->upperX) &&
        ($y >= $this->lowerY && $y <= $this->upperY);
    }
}