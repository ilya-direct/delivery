<?php


namespace Delivery\Companies\Bird;

use Delivery\Item;
use Delivery\ItemInterface;

interface Interactor
{
    /**
     * @param string $addressA
     * @param string $addressB
     * @param ItemInterface[] $items
     * @return Response
     *
     * @throws InteractorException
     */
    public function getCost(string $addressA, string $addressB, array $items): Response;
}
