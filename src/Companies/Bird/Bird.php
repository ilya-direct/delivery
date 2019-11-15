<?php


namespace Delivery\Companies\Bird;


use Delivery\IDeliveryCompany;
use Delivery\DeliveryInfo;
use Delivery\Exceptions\CalculationException;
use Delivery\ItemInterface;

class Bird implements IDeliveryCompany
{
    const NAME = 'bird';

    private $interactor;

    public function __construct(Interactor $interactor)
    {
        $this->interactor = $interactor;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @param string $addressA
     * @param string $addressB
     * @param ItemInterface[] $items
     * @return DeliveryInfo
     * @throws CalculationException
     */
    public function getDeliveryInfo(string $addressA, string $addressB, array $items): DeliveryInfo
    {
        try {
            $response = $this->interactor->getCost($addressA, $addressB, $items);

            $cost = (int)floor($response->cost());

            // Today day
            $plusDays = $response->daysCount() - 1;
            $dateInterval = new \DateInterval(sprintf("P%dD", $plusDays));
            $date = new \DateTime();
            $date->setTime(0,0,0);
            $date->add($dateInterval);

            $deliveryInfo = new DeliveryInfo($cost, clone $date);

        } catch (InteractorException $e) {

            throw new CalculationException('Integration Exception');
        }


        return $deliveryInfo;
    }
}
