<?php


namespace Delivery;


use Delivery\Exceptions\CalculationException;

interface IDeliveryCompany
{
    public function getName(): string;

    /**
     * @param string $addressA
     * @param string $addressB
     * @param array $items
     * @return DeliveryInfo
     * @throws CalculationException
     */
    public function getDeliveryInfo(string $addressA, string $addressB, array $items): DeliveryInfo;
}
