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

        function loopArray($array, $value)
        {
            foreach ($array as $customerGroup) {
                if ($customerGroup->getId() == $value) {
                    return $customerGroup;
                }
            }
        }

        $totalPrice = 0;
        $productBasePrice = 0;
        $customerData = [];
        $productArray = [];
        $productArray[1] = "";
        if (isset($POST['customers']) && isset($POST['product'])) {
            $customerName = $POST['customers'];
            $productData = $POST['product'];
            $result = explode(",", $customerName);
            $groupId = $result[0];
            //var_dump($result);
            $productArray = explode(",", $productData);
            $productBasePrice = $productArray[0];
            //var_dump($object);
            //$customer = $customers->getCustomerById($customerId);

            //loop through all data to get parent IDs
            $object = loopArray($getCustomerGroups, $groupId);
            if ($object->getVariableDiscount() == null) {
                array_push($customerData, $object);

                do {
                    $object = loopArray($getCustomerGroups, $object->getParentId());
                    array_push($customerData, $object);

                } while ($object->getParentId() !== null);

            } elseif ($object->getVariableDiscount() !== null) {
                array_push($customerData, $object);

                do {
                    $object = loopArray($getCustomerGroups, $object->getParentId());
                    array_push($customerData, $object);

                } while ($object->getParentId() !== null);
            }

            $variableDiscount = 0;
            $fixedDiscount = 0;
            //get the correct variable discount & the fixed discount
            for ($i = 0; $i < count($customerData); $i++) {

                if ($variableDiscount < $customerData[$i]->getVariableDiscount()) {
                    $variableDiscount = $customerData[$i]->getVariableDiscount();
                }
                if ($customerData[$i]->getFixedDiscount() != null) {
                    $fixedDiscount += $customerData[$i]->getFixedDiscount();
                }
            }

            //convert product base price to float to be able to calc its variable discount (it being a percentage)
            $variable = ($productBasePrice / 100) * $variableDiscount;
            // * 100 to be able to subtract correctly from DB price
            $fixed = $fixedDiscount * 100;
            $discount = 0;
            $varOrFixed = "";

            if ($variable > $fixed) {
                $discount = $variableDiscount;
                $varOrFixed = "variable";

            } else {
                $discount = $fixed;
                $varOrFixed = "fixed";
            }

            if ($varOrFixed == "variable" && $result[2] != "") {
                if ($discount < $result[2]) {
                    $discount = $result[2];
                }
            }

            //calculate total price
            $totalPrice = 0;
            if ($varOrFixed == "variable" && $result[2] != "") {
                $percent = ($productBasePrice / 100) * $discount;
                $totalPrice = $productBasePrice - $percent;

            } elseif ($varOrFixed == "variable" && $result[2] == "") {
                $totalPrice = $productBasePrice - ($result[1] * 100);
                $percent = ($totalPrice / 100) * $discount;
                $totalPrice = $totalPrice - $percent;

            } elseif ($varOrFixed == "fixed" && $result[2] != "") {
                $totalPrice = $productBasePrice - $discount;
                $percent = ($totalPrice / 100) * $result[2];
                $totalPrice = $totalPrice - $percent;

            } else {
                $totalPrice = $productBasePrice - $discount;
                $totalPrice = $productBasePrice - ($result[1] * 100);
            }

            //price can't be under 0
            if ($totalPrice < 0) {
                $totalPrice = 0;
            }
            
        }

        require 'View/Homepage.php';
    }
}