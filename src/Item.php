<?php


namespace Delivery;


class Item
{
    /** @var float kilograms */
    private $weight;

    // Dimentions in millimeters

    /** @var int */
    private $height;
    /** @var int */
    private $width;
    /** @var int */
    private $depth;
    /** @var int */
    private $quantity;

    public function __construct(int $height, int $width, int $depth, float $weight, int $quantity)
    {
        $this->height = $height;
        $this->width = $width;
        $this->depth = $depth;
        $this->weight = $weight;
        $this->quantity = $quantity;
    }

    public function weight(): int
    {
        return $this->weight;
    }

    public function height(): int
    {
        return $this->height;
    }

    public function width(): int
    {
        return $this->width;
    }

    public function depth(): int
    {
        return $this->depth;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }
}
