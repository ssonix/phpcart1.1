<?php
 include('../connectdatabase.php');

$date = date("Y-m-d H:i:s");

if(isset($_POST['add'])){
    //select cart for current logged user
    //session -> user_id
    //select carts by user_id : CART -> id

    var_dump(strval($date));
    $sql = "INSERT INTO `cart_products` (`cart_id`,`product_id`, `quantity`, `price`) VALUES 
( " . intval($_SESSION['cart_id']) . ", " . intval($_POST["hidden_id"]) . ", " . intval($_POST["quantity"]) . ", " . intval($_POST["hidden_price"]) .")";




    $result = mysqli_query($db, $sql);
//    var_dump($_SESSION['cart_id']);
//var_dump($result);
//    var_dump($_POST);
    var_dump($db);
    header('location: ../../index.php');
};

