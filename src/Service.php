<?php


namespace Delivery;


use Delivery\Companies\Bird\Bird;
use Delivery\Exceptions\CalculationException;
use Delivery\Exceptions\CompanyNotFoundException;
use Delivery\Companies\Turtle\Turtle;

class Service
{
    /** @var CompaniesDI*/
    private $di;

    /**
     * Service constructor.
     * @param CompaniesDI $di
     */
    public function __construct(CompaniesDI $di)
    {
        $this->di = $di;
    }

    /**
     * @param string $addressA
     * @param string $addressB
     * @param ItemInterface[] $items
     * @param string $companyName
     * @return DeliveryInfo
     * @throws CompanyNotFoundException|CalculationException
     */
    public function priceByCompany(string $addressA, string $addressB, array $items, string $companyName): DeliveryInfo
    {
        // TODO: check items instance of ItemInterface
        // TODO: check items empty
        // TODO: check addressA, addressB

        if (!in_array($companyName, $this->availableCompanies())) {
            throw new CompanyNotFoundException();
        }

        $company = $this->di->get($companyName);

        $deliveryInfo = $company->getDeliveryInfo($addressA, $addressB, $items);

        return $deliveryInfo;
    }

    /**
     * @param string $addressA
     * @param string $addressB
     * @param ItemInterface[] $items
     * @return DeliveryInfo[] (companyName => DeliveryInfo)
     */
    public function allPrices(string $addressA, string $addressB, array $items): array
    {
        // TODO: check items instance of ItemInterface
        // TODO: check items empty
        // TODO: check addressA, addressB

        $result = [];
        foreach ($this->availableCompanies() as $companyName) {
            $company = $this->di->get($companyName);
            try {
                $info = $company->getDeliveryInfo($addressA, $addressB, $items);
            } catch (CalculationException $e) {
                // TODO: notify admin
                continue;
            }
            $result[$company->getName()] =  $info;
        }

        return $result;
    }

    private function availableCompanies()
    {
        return [
            Bird::NAME,
            Turtle::NAME,
        ];
    }
}
