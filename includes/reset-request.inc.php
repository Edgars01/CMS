<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["reset-request-submit"]))
{
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    // won't work locally
    $url = "http://localhost:63342/cms/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;

    require 'dbh.inc.php';

    $userEmail = $_POST["email"];

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
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        echo 'There was an error!';
        exit();
    }
    else
    {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to = $userEmail;

    $subject = 'Reset your password';
    $message = '<p>We received a password request. Click link to reset your password, or ignore it</p>';
    $message.= '<br>This is your password reset link: </br>';
    $message .= '<a href="' . $url . '">'. $url . '</a>';

    $headers = "From Svarups <edgars27svarups@gmail.com>\r\n";
    $headers .= "Reply-To: Svarups <edgars27svarups@gmail.com>\r\n";
    $headers .= "Content-type: text/html\r\n";

    //mail($to, $subject, $message, $headers);




    require '/Users/edgars/Desktop/projectsMain/cms/phpmailer/src/Exception.php';
    require '/Users/edgars/Desktop/projectsMain/cms/phpmailer/src/PHPMailer.php';
    require '/Users/edgars/Desktop/projectsMain/cms/phpmailer/src/SMTP.php';


    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = '*******@gmail.com'; // Your gmail
    $mail->Password = '**************'; // Your gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('*******@gmail.com'); // Your gmail

    $mail->addAddress($to);

    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();




    header("Location: ../reset-password.php?reset=success");
}
else
{
    header("Location: ../index.php");
}