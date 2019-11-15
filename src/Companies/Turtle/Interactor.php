<?php


namespace Delivery\Companies\Turtle;


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
    public function getRateAFndDate(string $addressA, string $addressB, array $items): Response;
}
