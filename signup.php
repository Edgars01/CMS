<head>
    <meta charset="utf-8">
    <title> CMS </title>

    <style> <?php include "/Users/edgars/Desktop/cms/css/signupStyle.css" ?> </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/script.js"></script>

</head>

<body>



</form>

<?php
if (isset($_GET["error"]))
{
    // sign up
    if($_GET["error"] == "emptyinput")
    {
        echo "<p>Fill in all fields!</p>";
    }
    elseif ($_GET["error"] == "invaliduid")
    {
        echo "<p>Choose a proper username!</p>";
    }
    elseif ($_GET["error"] == "invalidemail")
    {
        echo "<p>Choose a proper email!</p>";
    }
    elseif ($_GET["error"] == "passwordsdontmatch")
    {
        echo "<p>Passwords doesn't match!</p>";
    }
    elseif ($_GET["error"] == "stmtfailed")
    {
        echo "<p>Something went wrong, try again!</p>";
    }
    elseif ($_GET["error"] == "usernametaken")
    {
        echo "<p>Username already taken!</p>";
    }
    elseif ($_GET["error"] == "none")
    {
        echo "<p>You have signed up!</p>";
    }
    //login
    elseif ($_GET["error"] == "wornglogin")
    {
        echo "<p>Incorrect login information!</p>";
    }
}
?>
<div class="container" id="container">

    <div class="form-container sign-up-container">
        <form action="includes/signup.inc.php" method="post">
            <h1>Create Account</h1>
            <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your email for registration</span>
            <input type="text" name="name" placeholder="Name" />
            <input type="email" name="email" placeholder="Email" />
            <input type="text" name="uid" placeholder="Username" />
            <input type="password" name="pwd" placeholder="Password" />
            <input type="password" name="pwdrepeat" placeholder="Repeat Password" />
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>


    <div class="form-container sign-in-container">


        <form action="includes/login.inc.php" method="post">
            <h1>Sign in</h1>
            <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your account</span>
            <input type="text" name="uid" placeholder="Username/Email" />
            <input type="password" name="pwd" placeholder="Password" />
            <a href="#">Forgot your password?</a>
            <button type="submit" name="submit">Sign In</button>
        </form>


    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button id="signIn" class="ghost">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start journey with us</p>
                <button id="signUp" class="ghost">Sign Up</button>
            </div>
        </div>
    </div>
</div>

<div>
    <a href="index.php"><button class="backBtn">Back</button></a>
</div>

<footer>
    <p>
        footer
    </p>
</footer>


</body>
</html>


