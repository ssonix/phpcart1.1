<?php
 include('../connectdatabase.php');

$date = date("Y-m-d H:i:s");

if(isset($_POST['add'])){
    //select cart for current logged user
    //session -> user_id
    //select carts by user_id : CART -> id

    $sql = "INSERT INTO `cart_products` (`cart_id`,`product_id`, `quantity`, `price`, `created`) VALUES 
( " . intval($_SESSION['cart_id']) . ", " . intval($_POST["hidden_id"]) . ", " . intval($_POST["quantity"]) . ", " . intval($_POST["hidden_price"]) .", '". $date ."')";

    $result = mysqli_query($db, $sql);
//    var_dump($_SESSION['cart_id']);
//var_dump($result);
//    var_dump($_POST);
    header('location: ../../index.php');
};

