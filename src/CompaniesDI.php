<?php


namespace Delivery;

class CompaniesDI
{
    // $name => $deliveryCompany (IDeliveryCompany)
    private $initialized = [];

    // $name => $callback
    private $container = [];

    /**
     * CompaniesDI constructor.
     * @param array $companies $name => $callback
     */
    public function __construct(array $companies)
    {
        $this->container = $companies;
    }

    public function get(string $name): IDeliveryCompany
    {
        if (array_key_exists($name, $this->initialized)) {
            return  $this->initialized[$name];
        }

        if (array_key_exists($name, $this->container)) {

            try {
                $this->initialized[$name] = $this->container[$name]();
            } catch (\Throwable $exception) {
                throw new \Exception('Failed to initialize company ' . $name . '.' . $exception->getMessage());
            }

            if (!($this->initialized[$name] instanceof IDeliveryCompany)) {
                throw new \Exception('Company must implement IDeliveryCompany');
            }

            return  $this->initialized[$name];
        }

        throw new \Exception('Company not found in config. Name: ' . $name);
    }
}
