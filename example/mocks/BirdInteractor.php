<?php

use Delivery\Companies\Bird\Interactor;
use Delivery\Companies\Bird\Response;
use Delivery\Companies\Bird\InteractorException;

class BirdInteractor implements Interactor
{
    public function getCost(string $addressA, string $addressB, array $items): Response
    {
        if ($addressA == 'Москва' && $addressB == 'Питер') {

            throw new InteractorException('Cannot calculate');
        }

        return new Response(555.34, 4);

    }

}