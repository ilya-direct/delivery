<?php


namespace Delivery\Companies\Turtle;


use Delivery\IDeliveryCompany;
use Delivery\DeliveryInfo;
use Delivery\Exceptions\CalculationException;
use Delivery\ItemInterface;

class Turtle implements IDeliveryCompany
{
    const NAME = 'turtle';

    private $repository;
    private $interactor;

    public function __construct(IRepository $repository, Interactor $interactor)
    {
        $this->repository = $repository;
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
            $basePrice = $this->repository->getBasePrice();
            $response = $this->interactor->getRateAFndDate($addressA, $addressB, $items);
        } catch (RepositoryException|InteractorException $e) {

            throw new CalculationException();
        }

        $cost = (int)floor($basePrice * $response->rate());
        $deliveryDate = $response->deliveryDate();
        $deliveryDate->setTime(0,0,0);
        $deliveryInfo = new DeliveryInfo($cost, $deliveryDate);

        return $deliveryInfo;
    }

}
