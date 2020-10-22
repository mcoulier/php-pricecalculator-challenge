<?php

class CustomerGroupLoader extends Connection
{
    private array $customer_groups = [];

    public function __construct()
    {
        $handle = $this->openConnection()->prepare('SELECT * FROM customer_group');
        $handle->execute();
        foreach ($handle->fetchAll() as $customer_group) {
            $this->customer_groups[] = new CustomerGroup(
                $customer_group['id'],
                $customer_group['name'],
                $customer_group['parent_id'],
                $customer_group['fixed_discount'],
                $customer_group['variable_discount']
            );
        }
    }

    /**
     * @return array
     */
    public function getCustomerGroups(): array
    {
        return $this->customer_groups;
    }
}
