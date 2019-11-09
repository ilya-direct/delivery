<?php

use Delivery\Companies\Turtle\Interactor;
use Delivery\Companies\Turtle\Response;
use Delivery\Companies\Turtle\InteractorException;


class TurtleInteractor implements Interactor
{
    public function getRateAFndDate(string $addressA, string $addressB, array $items): Response
    {
        if ($addressA == $addressB) {

            throw new InteractorException('Same addresses cannot be');
        }

        return new Response(1.5, new DateTime());
    }
}