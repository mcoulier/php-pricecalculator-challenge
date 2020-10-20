<?php

class ProductLoader extends Connection
{
    private array $products = [];

    public function __construct()
    {
        $handle = $this->openConnection()->prepare('SELECT * FROM product');
        $handle->execute();
        foreach ($handle->fetchAll() as $product){
            $this->products[] = new Product($product['id'], $product['name'], $product['price']);
        }
    /*    $result = $handle->fetchAll();*/
    }
}