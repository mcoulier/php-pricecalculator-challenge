<?php

declare(strict_types=1);

class CalculatorController
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        echo 'calculatorController<br/>';
        $customerLoader = new CustomerLoader();
        $customers = $customerLoader->getCustomers();

        $productLoader = new ProductLoader();
        $products = $productLoader->getProducts();

        //if this is form submit try to calc the final price
        $customer = null;
        if(isset($POST)){
            //fetch the selected customer from the db
            if(isset($POST['customer'])){
                $customerId = intval($POST['customer']);
                $customer = $customerLoader->getCustomerById($customerId);
            }
            //fetch the selected product from the db

            //if we have both product and costumer calc final price
            if ($customer && $product){

            }
        }

        require 'View/Homepage.php';
    }
}

