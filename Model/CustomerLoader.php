<?php

class CustomerLoader extends Connection
{
    private array $customers = [];

    /**
     * CustomerLoader constructor.
     * @param array $customers
     */
    public function __construct()
    {
        $handle = $this->openConnection()->prepare('SELECT * FROM customer');
        $handle->execute();
        foreach ($handle->fetchAll() as $customer) {
            $this->customers[] = new Customer(
                $customer['id'],
                $customer['firstname'],
                $customer['lastname'],
                $customer['group_id'],
                $customer['fixed_discount'],
                $customer['variable_discount']
            );
        }
    }

    /**
     * @return array
     */
    public function getCustomers(): array
    {
        return $this->customers;

    }
}
