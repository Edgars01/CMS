<?php

if (isset($_POST["reset-password-submit"]))
{
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];

    if (empty($password) || empty($passwordRepeat))
    {
        header("Location: ../signup.php?newpwd=empty");
        exit();
    }
    else if ($password != $passwordRepeat)
    {
        header("Location: ../signup.php?newpwd=pwdnotsame");
        exit();
    }

    $currentDate = date("U");
    require 'dbh.inc.php';

    // using selector token, not the validator. select selector token from db, and validator validates
    // proper user. these things are separate for security reasons. Question marks are placeholders.
    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        echo 'There was an error!';
        exit();
    }
    else
    {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result))
        {
            echo "You need to re-submit your reset request";
            exit();
        }
        else
        {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if ($tokenCheck === false)
            {
                echo "You need to re-submit your reset request";
                exit();
            }
            else if ($tokenCheck === true)
            {
                $tokenEmail = $row["pwdResetEmail"];

                $sql = "SELECT * FROM users WHERE usersEmail=?;";

                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql))
                {
                    echo 'There was an error!';
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);

                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result))
                    {
                        echo "There was an error";
                        exit();
                    }
                    else
                    {
                        $sql = "UPDATE users SET usersPwd=? WHERE usersEmail=?";

                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            echo 'There was an error!';
                            exit();
                        }
                        else
                        {
                            $newPwdHash = password_hash($password, PASSWORD_DEFAULT);

                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);


                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql))
                            {
                                echo 'There was an error!';
                                exit();
                            }
                            else
                            {
                                mysqli_stmt_bind_param($stmt, "s", $userEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../signup.php?newpwd=passwordupdated");
                            }
                        }
                    }
                }
            }
        }
    }
}
else
{
    header("Location: ../index.php");
}