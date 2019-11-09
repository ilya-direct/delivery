<?php


namespace Delivery;


class DeliveryInfo
{
    /** @var int */
    private $cost;

    /** @var \DateTime */
    private $date;

    public function __construct(int $cost, \DateTime $date)
    {
        $this->cost = $cost;
        $this->date = $date;
    }

    public function cost(): int
    {
        return $this->cost;
    }

    public function date(): \DateTime
    {
        return $this->date;
    }
}
