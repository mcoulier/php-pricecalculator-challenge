<?php

class CustomerLoader extends Connection
{
    private array $customers = [];

    /**
     * CustomerLoader constructor.
     * @param array $customers
     */
    public function __construct(array $customers)
    {
        $this->customers = $customers;

        $handle = $this->openConnection()->prepare('SELECT * FROM customer');
        $handle->execute();
        foreach ($handle->fetchAll() as $customer) {
            $this->customers[] = new Product($customer['id'], $customer['name'], $customer['price']);
        }


    }
}