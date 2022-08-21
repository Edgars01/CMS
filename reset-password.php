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
            <h1>Reset your password</h1>
            <p>Fill in field to receive a temporary password via email.</p>
            <form action="includes/reset-request.inc.php" method="post">
                <input type="text" name="email" placeholder="e-mail..">
                <button type="submit" name="reset-request-submit">Receive new password by e-mail</button>
            </form>
                <?php
                    if (isset($_GET["reset"]))
                    {
                        if ($_GET["reset"] == "success")
                        {
                            echo '<p class="signupSuccess"> Check your e-mail</p>';
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


