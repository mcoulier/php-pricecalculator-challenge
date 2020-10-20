<?php

require 'Model/Connection.php';

class ProductLoader extends Connection
{
    public function __construct()
    {
        $handle = $this->openConnection()->prepare('SELECT * FROM product');
        $handle->execute();
    }

}

