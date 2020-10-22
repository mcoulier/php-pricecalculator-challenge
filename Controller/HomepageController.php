<?php

class HomepageController
{
//render function with both $_GET and $_POST vars available if it would be needed.
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        $products = new ProductLoader();
        $getProducts = $products->getProducts();
        $customers = new CustomerLoader();
        $getCustomers = $customers->getCustomers();
        $customerGroups = new CustomerGroupLoader();
        $getCustomerGroups = $customerGroups->getCustomerGroups();

        function loopArray($array, $value){
            foreach ($array as $customerGroup){
                if ($customerGroup->getId() == $value){
                    return $customerGroup;
                }
            }

        }

        //if this is form submit try to calc the final price
        if(isset($POST['customers']) && isset($POST['product'])){

            $customerInput = $POST['customers'];
            $getProductPrice = $POST['product'];
            $result = explode(",", $customerInput);
            $customerObject = loopArray($getCustomerGroups, $customerInput);
            var_dump($customerObject);

            if ($customerObject->getVariableDiscount() == null){

            }



                $customerFixedDiscount = $result[1];
                $customerVarDiscount = $result[2];
/*                $customerGroupArray = explode(",", $custGroupArray);*/
/*                $custGrpFixed = $customerGroupArray[3];*/


/*                $customer = $customers->getCustomerById($customerId);*/

/*                $productArray = explode(",", $productId);*/
/*                $productBasePrice = $productArray[0];*/



/*            do ($customerFixedDiscount)*/


            //fetch the selected product from the db

            //if we have both product and costumer calc final price

        }

        require 'View/Homepage.php';
    }
}