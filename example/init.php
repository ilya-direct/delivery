<?php

use Delivery\Companies\Bird\Bird as Bird;
use Delivery\Companies\Turtle\Turtle as Turtle;
use Delivery\Service as Service;

require __DIR__ . '/mocks/BirdInteractor.php';
require __DIR__ . '/mocks/TurtleInteractor.php';
require __DIR__ . '/mocks/TurtleRepository.php';
require __DIR__ . '/mocks/Item.php';


//$birdCompany = new Bird(new  BirdInteractor());
//$turtleCompany = new Turtle(new TurtleRepository(), new  TurtleInteractor());


$service = new Service(new Delivery\CompaniesDI([
    Bird::NAME => function () {
        return new Bird(new  BirdInteractor());
    },
    Turtle::NAME => function () {
        return new Turtle(new TurtleRepository(), new  TurtleInteractor());
    },
]));

return $service;