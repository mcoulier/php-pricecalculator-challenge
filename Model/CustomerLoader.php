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
                $customer['firstname'],     //always use name from db between squarebrackets
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

    public function getCustomerById(int $id)
    {
        $handle = $this->openConnection()->prepare('SELECT * FROM customer WHERE id = :id');
        $handle->bindParam(':id', $id);
        $handle->execute();
        $customer = $handle->fetch();
        if($customer){
            return new Customer(
                $customer['id'],
                $customer['firstname'],     //always use name from db between square brackets
                $customer['lastname'],
                $customer['group_id'],
                $customer['fixed_discount'],
                $customer['variable_discount']
            );
        }
    }
}
