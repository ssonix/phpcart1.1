<?php
session_start();
date_default_timezone_set('Europe/Berlin');

$email = "";
$errors = array();

$db = mysqli_connect("localhost", "root", "password", "shopping_cart");

if (mysqli_connect_error()) {
    die ("problem z połączeniem z baza danych");
}
//sprawdza czy wszystkie pola sa uzupelnione
if (isset($_POST['register'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    //walidacja
    if (empty($email)) {
        array_push($errors, "email jest wymagany");
    }
    if (empty($password_1)) {
        array_push($errors, "haslo jest wymagane");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "Hasła się nie pokrywają");
    }
    //jesli nie bedzie bledow, wprowadz dane do bazy
    if (count($errors) == 0) {
//        create user
        $password = md5($password_1);
        $sql = "INSERT INTO `users` (`email`, `password`) VALUES ('" . mysqli_real_escape_string($db, $_POST['email']) . "', '" . mysqli_real_escape_string($db, $_POST['password_1']) . "')";
        mysqli_query($db, $sql);

        $user_id = (mysqli_insert_id($db));
        $_SESSION['user_id'] = $user_id;
        $date = date("Y-m-d H:i:s");

//        create cart
        $sql = "INSERT INTO `cart`(`user_id`, `created`) VALUES ('$user_id', '$date')";
        mysqli_query($db, $sql);

        $cart_id = (mysqli_insert_id($db));
        $_SESSION['cart_id'] = $cart_id;
    }
    //create cart

    header('location: index.php');
}