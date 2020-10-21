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
/*        $getCustomers = $customers->getCustomers();*/
/*        var_dump($customerGroups);*/

        function loopArray($array, $value){
            foreach ($array as $customerGroup){
                if ($customerGroup->getId() == $value){
                    /*                            var_dump($customerGroup);*/
                    return $customerGroup;
                }
            }

        }

        //if this is form submit try to calc the final price
        if(isset($POST)){
            //fetch the selected customer from the db
            if(isset($POST['customers'])){
                $customerId = $POST['customers'];
/*                $customerVariableDiscount = $POST['customers'];*/
                $result = explode(",", $customerId);
/*                var_dump($result);*/
                $groupId = $result[0];
                var_dump($groupId);


                $object = loopArray($getCustomerGroups, $groupId);
                var_dump($object);

/*                $customer = $customers->getCustomerById($customerId);*/
            }

            //fetch the selected product from the db

            //if we have both product and costumer calc final price

        }

        require 'View/Homepage.php';
    }
}