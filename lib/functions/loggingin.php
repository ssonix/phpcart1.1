<?php


$db = mysqli_connect("localhost", "root", "password", "shopping_cart");

if (isset($_POST['username']) and isset($_POST['password'])){

        $email = $_POST['email'];
    $password = $_POST['password'];
//sprawdz czy uzytkownik jest w bazie
    $query = "SELECT * FROM `users` WHERE username ='$email' and password='$password'";

//    $query = "SELECT * FROM `users` WHERE username =('". mysqli_real_escape_string($db, $_POST['email']) ."') and password =('". mysqli_real_escape_string($db, $_POST['password']) ."')";

    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $count = mysqli_num_rows($result);
//    Jeśli znajdzie to tworz sesje i loguj
    if ($count == 1){
        $_SESSION['email'] = $email;
    }
    var_dump($_SESSION);
    header('location: index.php');
}
