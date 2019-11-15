<?php


namespace Delivery;


interface ItemInterface
{
    public function weight(): int;
    public function height(): int;
    public function width(): int;
    public function depth(): int;
    public function quantity(): int;
}
