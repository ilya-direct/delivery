<?php

use Delivery\Companies\Turtle\IRepository;


class TurtleRepository implements IRepository
{
    public function getBasePrice(): float
    {
        return 100;
    }

}