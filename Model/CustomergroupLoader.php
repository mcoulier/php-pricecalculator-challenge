<?php


class CustomergroupLoader extends Connection
{
    private array $customer_groups = [];

    public function __construct()
    {
        $handle = $this->openConnection()->prepare('SELECT * FROM customer_group');
        $handle->execute();
        foreach ($handle->fetchAll() as $customer_group) {
            $this->customer_groups[] = new Product($customer_group['id'], $customer_group['name'], $customer_group['price']);
        }
        /*    $result = $handle->fetchAll();*/
        //print_r($this->products);
    }


}