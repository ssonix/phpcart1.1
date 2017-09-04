<?php

$email = "";
$error = array();

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
        array_push($error, "email jest wymagany");
    }
    if(empty($password_1)) {
        array_push($error, "haslo jest wymagane");
    }
    if ($password_1 != $password_2) {
        array_push($error, "hasła się nie pokrywają");
    }
    //jesli nie bedzie bledow, wprowadz dane do bazy
    if(count($error) ==0) {
        $password = md5($password_1); // encrypt password
        $sql = "INSERT INTO `users` (`email`, `password`) VALUES ('". mysqli_real_escape_string($db, $_POST['email']) ."',
         '". mysqli_real_escape_string($db, $_POST['password']) ."')";
        mysqli_query($db, $sql);
    }

}