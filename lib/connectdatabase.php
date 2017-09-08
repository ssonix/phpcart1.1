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
//        create user
        $password = md5($password_1);
        $sql = "INSERT INTO `users` (`email`, `password`) VALUES ('" . mysqli_real_escape_string($db, $_POST['email']) . "', '" . mysqli_real_escape_string($db, $_POST['password_1']) . "')";
        mysqli_query($db, $sql);

        $user_id = (mysqli_insert_id($db));
        $_SESSION['user_id'] = $user_id;
        $date = date("Y-m-d H:i:s");
    }
            //create cart
        if (mysqli_query($db, $sql)) {
            $sql = "INSERT INTO `cart`(`user_id`, `created`) VALUES ('$user_id', '$date')";
            mysqli_query($db, $sql);

            $cart_id = (mysqli_insert_id($db));
            $_SESSION['cart_id'] = $cart_id;
//            var_dump($sql);
//            var_dump($cart_id);
        }
        header('location: index.php');
    }

//    Logowanie
//
//if (isset($_POST['username']) and isset($_POST['password'])){
//
//    //    $email = $_POST['email'];
////    $password = $_POST['password'];
////sprawdz czy uzytkownik jest w bazie
///// //    $query = "SELECT * FROM `users` WHERE username ='$email' and password='$password'";
//
//    $query = "SELECT * FROM `users` WHERE username =('". mysqli_real_escape_string($db, $_POST['email']) ."') and password =('". mysqli_real_escape_string($db, $_POST['password']) ."')";
//
//    $result = mysqli_query($db, $query) or die(mysqli_error($db));
//    $count = mysqli_num_rows($result);
////3.1.2 If the posted values are equal to the database values, then session will be created for the user.
//    if ($count == 1){
//        $_SESSION['email'] = $email;
//    }
//}
////header('location: index.php');





//    else{
////3.1.3 If the login credentials doesn't match, he will be shown with an error message.
//        $fmsg = "Nieprawidłowe dane do logowania";
//    }
//}
////3.1.4 if the user is logged in Greets the user with message
//if (isset($_SESSION['email'])){
//    $email = $_SESSION['email'];
//    echo "Hai " . $email . "
//";
//    echo "This is the Members Area
//";
//    echo "<a href='logout.php'>Logout</a>";
//
//}
//3.2 When the user visits the page first time, simple login form will be displayed.}