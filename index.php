<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'config.php';

if (isset($_POST['submit'])) {
  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = $config['gmail_username'];
  $mail->Password = $config['gmail_password'];
  $mail->SMTPSecure = 'ssl';
  $mail->Port = $config['port'];

  $mail->setFrom('monirsaikat1@gmail.com', 'Monir Saikat');
  $mail->addAddress($_POST['email']);
  $mail->Subject = $_POST['subject'];
  $mail->Body = $_POST['message'];
  $mail->send();

  try {
    $mail->send();
    echo 'Mail sent successfully!';
  } catch (Exception $e) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>title</title>
</head>

<body>
  <form action="index.php" method="post">
    <input type="email" name="email" id="email">
    <input type="subject" name="subject" placeholder="Subject">
    <input type="message" name="message" placeholder="message">

    <input type="submit" name="submit" value="Send">
  </form>
</body>

</html>
