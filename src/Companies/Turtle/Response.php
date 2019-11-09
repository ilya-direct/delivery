<?php


namespace Delivery\Companies\Turtle;


class Response
{
    /** @var float */
    private $rate;
    /** @var \DateTime */
    private $deliveryDate;

    public function __construct(float $rate, \DateTime $deliveryDate)
    {
        $this->rate = $rate;
        $this->deliveryDate = $deliveryDate;
    }

    public function rate(): float
    {
        return $this->rate;
    }

    public function deliveryDate(): \DateTime
    {
        return $this->deliveryDate;
    }

}
