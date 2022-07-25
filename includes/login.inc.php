<?php


if (isset($_POST["submit"])) {

    $usename = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputLogin($usename, $pwd) !== false)
    {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $usename, $pwd);
}
else
{
    header("location: ../signup.php");
    exit();
}
