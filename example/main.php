<?php

use Delivery\Companies\Bird\Bird;
use Delivery\Companies\Turtle\Turtle;
use Delivery\Item;
use Delivery\Exceptions\CalculationException;
use Delivery\Exceptions\CompanyNotFoundException;

require_once(dirname(__DIR__) . '/vendor/autoload.php');

/** @var Delivery\Service $service */
$service = require(__DIR__ . '/init.php');

$items = [
    new Item(1, 2, 3, 0.3, 1),
    new Item(10, 20, 30, 1.3, 2),
    new Item(100, 200, 300, 2.3, 3),
];

// ex1
$info = $service->priceByCompany("Москва", "Иркутск", $items,Bird::NAME);
echo $info->cost() . ' ' . $info->date()->format("Y-m-d") . "\n"; // "555 2019-11-12"

// ex2
$info = $service->priceByCompany("Москва", "Иркутск", $items,Turtle::NAME);
echo $info->cost() . ' ' . $info->date()->format("Y-m-d") . "\n"; // "150 2019-11-25"

// ex3
try {
    $info = $service->priceByCompany("Москва", "Питер", $items, Bird::NAME);
} catch (CalculationException|CompanyNotFoundException $e) {
    //  catched calculation exception
    echo get_class($e) . "\n"; // CalculationException
}

// ex4
try {
    $info = $service->priceByCompany("Москва", "Иркутск", $items,'unknown company');
} catch (CalculationException|CompanyNotFoundException $e) {
    //  catched CompanyNotFoundException
    echo get_class($e) . "\n"; // CompanyNotFoundException
}

// ex5
$infos = $service->allPrices("addressA", "addressB", $items);
print_r($infos);
