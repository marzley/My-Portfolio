<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';

$receiving_email_address = 'sirkelvinwanyoike@gmail.com';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name    = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
  $email   = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
  $subject = isset($_POST['subject']) ? strip_tags(trim($_POST['subject'])) : 'Contact Form Message';
  $message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

  if ($name && $email && $message && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $mail = new PHPMailer(true);
    try {
      // SMTP config
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'your_gmail@gmail.com'; // Your Gmail address
      $mail->Password = 'your_app_password';    // App password (not your Gmail password)
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      $mail->setFrom($email, $name);
      $mail->addAddress($receiving_email_address);
      $mail->Subject = $subject;
      $mail->Body    = "From: $name\nEmail: $email\n\nMessage:\n$message";

      $mail->send();
      echo 'OK';
    } catch (Exception $e) {
      echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
  } else {
    echo 'Please fill in all required fields with a valid email.';
  }
} else {
  echo 'Invalid request.';
}
?>
