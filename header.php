<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title> CMS </title>

    <style> <?php include "css/mainStyle.css" ?> </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/Users/edgars/Desktop/cms/js/script.js"></script>

</head>

<body>

<nav class="nav">
    <div class="container">
        <div class="logo">
            <a href="#">Your Logo</a>
        </div>
        <div id="mainListDiv" class="main_list">
            <ul class="navlinks">
                <li><a href="#">About</a></li>
                <li><a href="#">Portfolio</a></li>
                <?php
                    if (isset($_SESSION["useruid"]))
                    {
                        echo "<li><a href='profile.php'>Profile Page</a></li>";
                        echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
                    }
                    else
                    {
                        echo "<li><a href='signup.php'>Login</a></li>";
                    }
                ?>
            </ul>
        </div>
        <span class="navTrigger">
                <i></i>
                <i></i>
                <i></i>
            </span>
    </div>
</nav>



</body>
</html>

