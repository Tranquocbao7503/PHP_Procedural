<?php

if (isset($_POST["submit"])) {

    // gap data from sign up form after clicking submit button
    $name = $_POST["name"];
    $email = $_POST["email"];
    $userName = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];


    require_once 'dbh_inc.php';
    require_once 'function_inc.php';

    if (emptyInputSignup($name, $email, $userName, $pwd, $pwdRepeat) !== false) {
        header("location: signup.php?error=emptyinput");
        exit();
    }


    if (invalidUid($userName) !== false) {
        header("location: signup.php?error=invalidUid");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: signup.php?error=invalidEmail");
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: signup.php?error=pwddontmatch");
        exit();
    }

    if (uIDExits($connection, $userName, $email) !== false) {
        header("location: signup.php?error=usernametaken");
        exit();
    }


    createUser($connection, $name, $email, $userName, $pwd);

    echo "Hecllo 1";
} else {
    echo "Hello";
    header("location: signup.php");
    exit();
}

?>