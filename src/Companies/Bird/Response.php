<?php


namespace Delivery\Companies\Bird;


class Response
{
    /** @var float */
    private $cost;
    /** @var int */
    private $daysCount;

    public function __construct(float $cost, int $daysCount)
    {
        $this->cost = $cost;
        $this->daysCount = $daysCount;
    }

    public function cost(): float
    {
        return $this->cost;
    }

    public function daysCount(): int
    {
        return $this->daysCount;
    }
}
