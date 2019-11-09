<?php


namespace Delivery\Companies\Bird;

use Delivery\Item;

interface Interactor
{
    /**
     * @param string $addressA
     * @param string $addressB
     * @param Item[] $items
     * @return Response
     *
     * @throws InteractorException
     */
    public function getCost(string $addressA, string $addressB, array $items): Response;
}
