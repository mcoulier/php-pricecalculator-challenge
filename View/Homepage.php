<!doctype html>
<html lang="en">
<head>
    <title>Price Calculator</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<form method="post">
    <!--Displaying customer names in dropdown, GroupID, Fixed & Variable discounts as option values-->
    <label>Customer</label>
    <select name="customers" id="customers">
        <?php foreach ($customers->getCustomers() as $customer) { ?>
            <option value="<?php echo $customer->getGroupId()?>,<?php echo $customer->getFixedDiscount()?>,<?php echo $customer->getVariableDiscount()?>"><?php echo $customer->getFirstname() . " " . $customer->getLastname() ?></option>
        <?php } ?>
    </select>

    <!--Displaying product names in dropdown, Price & Name in option value-->
    <label>Product</label>
    <select name="product" id="product">
        <?php foreach ($products->getProducts() as $product) { ?>
            <option value="<?php echo $product->getPrice()?>,<?php echo $product->getName()?>"><?php echo $product->getName()?></option>
        <?php } ?>
    </select>
    <button type="submit" class="btn btn-dark">Submit</button><br>


<!--Showing Product info, Final Price & Discount-->
<?php
echo "Product: ".$productArray[1]."<br>";
echo "Base price: " . "€ " . ($productBasePrice/100)."<br>";
echo "Your discount: " . "€ ". number_format(($productBasePrice-$totalPrice)/100, 2)."<br>";
echo "Total price: " . "€ ". number_format(($totalPrice/100), 2 )."<br>"?>
</form>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>