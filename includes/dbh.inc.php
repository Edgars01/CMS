<?php
// database handler

$serverName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "cms";

$conn = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);

if (!$conn)
{
    die('Connection failed:' . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS users (
        userId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
        usersName varchar(128) NOT NULL,
        usersEmail varchar(128) NOT NULL,
        usersUid varchar(128) NOT NULL,
        usersPwd varchar(128) NOT NULL)";

