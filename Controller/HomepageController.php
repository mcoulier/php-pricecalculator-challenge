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
            var_dump($result);
            $productArray = explode(",", $productData);
            $productBasePrice = $productArray[0];
            /*                var_dump($object);*/

            /*                $customer = $customers->getCustomerById($customerId);*/

            $object = loopArray($getCustomerGroups, $groupId);
            if($object->getVariableDiscount() == null){
                array_push($varDiscounts, $object);

                do{
                    $object = loopArray($getCustomerGroups, $object->getParentId());
                    array_push($varDiscounts, $object);

                } while($object->getParentId() !== null);

            } elseif ($object->getVariableDiscount() !== null){
                array_push($varDiscounts, $object);

                do{
                    $object = loopArray($getCustomerGroups, $object->getParentId());
                    array_push($varDiscounts, $object);

                }while($object->getParentId() !== null);
            }

            $variableDiscount = 0;
            $fixedDiscount = 0;

            for ($i = 0; $i < count($varDiscounts); $i++){

                if($variableDiscount < $varDiscounts[$i]->getVariableDiscount()){
                    $variableDiscount = $varDiscounts[$i]->getVariableDiscount();
                }
                if ($varDiscounts[$i]->getFixedDiscount() != null){
                    $fixedDiscount += $varDiscounts[$i]->getFixedDiscount();
                }
            }

            echo "this is variable ".$variableDiscount;
            echo "this is fixed ".$fixedDiscount;

            $variable = ($productBasePrice/100)*$variableDiscount;
            $fixed = $fixedDiscount*100;
            $discount = 0;
            $varOrFixed = "";

            if($variable > $fixed){
                $discount = $variableDiscount;
                $varOrFixed = "variable";
            } else {
                $discount = $fixed;
                $varOrFixed = "fixed";
            }

            if($varOrFixed == "variable" && $result[2] != ""){
                if ($discount < $result[2]){
                    $discount = $result[2];
                }
            }

            $totalPrice = 0;

            if($varOrFixed == "variable" && $result[2] != ""){
                $percent = ($productBasePrice/100)*$discount;
                $totalPrice = $productBasePrice - $percent;
            } elseif ($varOrFixed == "variable" && $result[2] == ""){
                $totalPrice = $productBasePrice - ($result[1]*100);
                $percent = ($totalPrice/100)*$discount;
                $totalPrice = $totalPrice - $percent;

            } elseif ($varOrFixed == "fixed" && $result[2] != ""){
                $totalPrice = $productBasePrice - $discount;
                $percent = ($totalPrice/100)*$result[2];
                $totalPrice = $totalPrice - $percent;
            } else {
                $totalPrice = $productBasePrice - $discount;
                $totalPrice = $productBasePrice - ($result[1]*100);
            }

            if($totalPrice < 0){
                $totalPrice = 0;
            }


            var_dump($varDiscounts);

/*            $varDiscount = $varDiscounts[0]->getVariableDiscount();

            var_dump($varDiscount);*/

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