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
        $varDiscounts = [];
        //fetch the selected customer from the db
        if(isset($POST['customers']) && isset($POST['product'])){
            $customerData = $POST['customers'];
            $productData = $POST['product'];
            $result = explode(",", $customerData);
            $groupId = $result[0];
            $customerFixedDiscount = $result[1];
            //var_dump($customerFixedDiscount);
            $customerVarDiscount = $result[2];
            //var_dump($result);
            /*                var_dump($object);*/

            /*                $customer = $customers->getCustomerById($customerId);*/

            $object = loopArray($getCustomerGroups, $groupId);
            if($object->getVariableDiscount() == null){
                array_push($varDiscounts, $object);

                do{
                    $object = loopArray($getCustomerGroups, $object->getParentId());
                    array_push($varDiscounts, $object);
                    var_dump($object);

                } while($object->getParentId() !== null);

            } elseif ($object->getVariableDiscount() !== null){
                array_push($varDiscounts, $object);

                do{
                    $object = loopArray($getCustomerGroups, $object->getParentId());
                    array_push($varDiscounts, $object);
                    var_dump($object);

                }while($object->getParentId() !== null);

            }


        }
        /*if (isset($POST['product'])){
            $productId = $POST['product'];
            $productArray = explode(",", $productId);
            var_dump($productArray);
            $productBasePrice = $productArray[0];

        }*/





        require 'View/Homepage.php';
    }
}