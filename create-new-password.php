<head>
    <meta charset="utf-8">
    <title> CMS </title>

    <style> <?php include "css/signupStyle.css" ?> </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/script.js"></script>

</head>

<body>




<main>
    <div clas="wrapper-main">
        <section class="section-default">

            <?php
                $selector = $_GET["selector"];
                $validator = $_GET["validator"];

                if (empty($selector) || empty($validator))
                {
                    echo "We could not validate your request";
                }
                else
                {
                    if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false)
                    {
                        ?>
                            <form action="includes/reset-password.inc.php" method="post">
                                <input type="hidden" name="selector" value="<?php echo $selector ?>">
                                <input type="hidden" name="validator" value="<?php echo $validator ?>">
                                <input type="password" name="pwd" placeholder="Enter a new password..">
                                <input type="password" name="pwd-repeat" placeholder="Repeat your password..">
                                <button type="submit" name="reset-password-submit"> Reset passeord</button>
                            </form>
                        <?php
                    }
                }
            ?>

        </section>
    </div>
</main>




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


