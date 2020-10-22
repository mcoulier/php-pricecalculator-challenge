<?php

class HomepageController
{
//render function with both $_GET and $_POST vars available if it would be needed.
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        $products = new ProductLoader();
        $customers = new CustomerLoader();
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
        if(isset($POST)){
            //fetch the selected customer from the db
            if(isset($POST['customers'])){
                $customerId = $POST['customers'];
                $result = explode(",", $customerId);
                $groupId = $result[0];
                $customerFixedDiscount = $result[1];
                var_dump($customerFixedDiscount);
                $customerVarDiscount = $result[2];
                var_dump($result);
                $object = loopArray($getCustomerGroups, $groupId);
/*                var_dump($object);*/

/*                $customer = $customers->getCustomerById($customerId);*/
            }
            if (isset($POST['product'])){
                $productId = $POST['product'];
                $productArray = explode(",", $productId);
                var_dump($productArray);
                $productBasePrice = $productArray[0];

            }


            //fetch the selected product from the db

            //if we have both product and costumer calc final price

        }

        require 'View/Homepage.php';
    }
}