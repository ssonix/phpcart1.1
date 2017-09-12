<?php
include ('../connectdatabase.php');
if (isset($_POST['order'])) {

//    create order
    $createorder = "INSERT INTO `orders` (`total`, `user_id`) VALUES 
(". 20 .", '" .$_SESSION['user_id']."')";
//    var_dump($createorder);
    mysqli_query($db, $createorder);

    $order_id = (mysqli_insert_id($db));
    $_SESSION['order_id'] = $order_id;
// draw order_products table
    $sql = "INSERT INTO `order_products` (`order_id`, `product_id`, `quantity`, `price`) 
    SELECT 20, `product_id`, `quantity`, `price` 
    FROM `cart_products` where cart_id = ". $_SESSION['cart_id'];
    mysqli_query($db, $sql);


    //delete cart
    $deletecart = "DELETE FROM `cart_products` WHERE cart_id= ".$_SESSION['cart_id'];
    mysqli_query($db, $deletecart);
    header('location: ../../sucess.php');
}