<?php

namespace JL\EnAlquilerTest;

use JL\EnAlquilerTest\Exceptions\InvalidMovementException;
use JL\EnAlquilerTest\Exceptions\InvalidOrientationException;

class Rover
{
    private $x;
    private $y;
    private $orientation;

    public function __construct($x, $y, $orientation)
    {
        $this->x = $x;
        $this->y = $y;
        $this->orientation = $orientation;
        if(!is_string($orientation) || (strlen($orientation) > 1) || (strpos('NSEW', $orientation) === false))
        {
            throw new InvalidOrientationException('You\'re trying to instantiate a Rover with an invalid orientation');
        }
    }

    public function x()
    {
        return $this->x;
    }

    public function y()
    {
        return $this->y;
    }

    public function orientation(){
        return $this->orientation;
    }

    public function move($movement)
    {
        if($movement === 'M') {
            $this->goForward();
        } else if($movement === 'R') {
            $this->rotateRight();
        } else if($movement === 'L') {
            $this->rotateLeft();
        } else {
            throw new InvalidMovementException('You\'re trying to do a invalid movement for a rover');
        }
    }

    public function __toString()
    {
        return "$this->x $this->y $this->orientation";
    }

    /*
     * We assume the coordinates could be positives and negatives
     */
    private function goForward()
    {
        switch ($this->orientation)
        {
            case 'E':
                $this->x += 1;
                break;
            case 'W':
                $this->x -= 1;
                break;
            case 'N':
                $this->y += 1;
                break;
            case 'S':
                $this->y -= 1;
                break;
        }
    }

    private function rotateRight()
    {
        $newOrientation = ['E'=>'S', 'W'=>'N', 'N'=>'E', 'S'=>'W'];
        $this->orientation = $newOrientation[$this->orientation];
    }

    private function rotateLeft()
    {
        $newOrientation = ['E'=>'N', 'W'=>'S', 'N'=>'W', 'S'=>'E'];
        $this->orientation = $newOrientation[$this->orientation];
    }

}