<?php


namespace Delivery\Companies\Turtle;


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
    public function getRateAFndDate(string $addressA, string $addressB, array $items): Response;
}
