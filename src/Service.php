<?php


namespace Delivery;


use Delivery\Companies\Bird\Bird;
use Delivery\Exceptions\CalculationException;
use Delivery\Exceptions\CompanyNotFoundException;
use Delivery\Exceptions\ConfigException;
use Delivery\Companies\Turtle\Turtle;

class Service
{
    /** @var IDeliveryCompany[] */
    private $deliveryCompanies;

    /**
     * Service constructor.
     * @param array $dc
     * @throws ConfigException
     */
    public function __construct(array $dc)
    {
        foreach ($this->availableCompanies() as $name) {

            if (!array_key_exists($name, $dc)) {
                throw new ConfigException('DeliveryCompany ' . $name . ' not exist');
            }

            $this->deliveryCompanies[$name] = $dc[$name];
        }
    }

    /**
     * @param string $addressA
     * @param string $addressB
     * @param Item[] $items
     * @param string $companyName
     * @return DeliveryInfo
     * @throws CompanyNotFoundException|CalculationException
     */
    public function priceByCompany(string $addressA, string $addressB, array $items, string $companyName): DeliveryInfo
    {
        // TODO: check items instance of Item
        // TODO: check items empty
        // TODO: check addressA, addressB

        $company = $this->companyByName($companyName);

        $deliveryInfo = $company->getDeliveryInfo($addressA, $addressB, $items);

        return $deliveryInfo;
    }

    /**
     * @param string $addressA
     * @param string $addressB
     * @param Item[] $items
     * @return DeliveryInfo[] (companyName => DeliveryInfo)
     */
    public function allPrices(string $addressA, string $addressB, array $items): array
    {
        // TODO: check items instance of Item
        // TODO: check items empty
        // TODO: check addressA, addressB

        $result = [];
        foreach ($this->deliveryCompanies as $company) {
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

    /**
     * @param string $name
     * @return IDeliveryCompany
     * @throws CompanyNotFoundException
     */
    private function companyByName(string $name): IDeliveryCompany
    {
        if (!in_array($name, $this->availableCompanies())) {
            throw new CompanyNotFoundException();
        }

        return $this->deliveryCompanies[$name];
    }
}
