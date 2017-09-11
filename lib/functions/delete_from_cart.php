<?php
include ('../connectdatabase.php');
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM `cart_products` WHERE id = ". intval($id) ." ";
    $result = mysqli_query($db, $sql);

    header('location: ../../index.php');

}