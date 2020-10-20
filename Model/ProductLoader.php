<?php

class ProductLoader extends Connection
{
    private array $products = [];

    public function __construct()
    {
        $handle = $this->openConnection()->prepare('SELECT * FROM product');
        $handle->execute();
        foreach ($handle->fetchAll() as $product){
            array_push($this->products, new Product($product['id'], $product['name'], $product['price']));
        }

    /*    $result = $handle->fetchAll();*/
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function dividePrice()
    {

    }
}