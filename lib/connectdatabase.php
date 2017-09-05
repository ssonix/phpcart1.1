<?php
session_start();

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
    if(empty($email)) {
        array_push($errors, "email jest wymagany");
    }
    if(empty($password_1)) {
        array_push($errors, "haslo jest wymagane");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "Hasła się nie pokrywają");
    }
    //jesli nie bedzie bledow, wprowadz dane do bazy
    if(count($errors) == 0) {
        $password = md5($password_1);
        $sql = "INSERT INTO `users` (`email`, `password`) VALUES ('". mysqli_real_escape_string($db, $_POST['email']) ."', '". mysqli_real_escape_string($db, $_POST['password_1']) ."')";
        mysqli_query($db, $sql);

        if (mysqli_query($db, $sql)) {
            $last_id = (mysqli_insert_id($db));
            $sql = "INSERT INTO `cart`(`user_id`) VALUES ('$last_id')";
            mysqli_query($db, $sql);
        }

        header('location: index.php');
    }

}