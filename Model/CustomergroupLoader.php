<?php


class CustomergroupLoader extends Connection
{
    private array $customergroups = [];

    public function __construct()
    {
        $handle = $this->openConnection()->prepare('SELECT * FROM product');
        $handle->execute();
        foreach ($handle->fetchAll() as $product) {
            $this->customergroups[] = new Product($product['id'], $product['name'], $product['price']);
            /*    $result = $handle->fetchAll();*/
            //print_r($this->products);
        }

    }
}