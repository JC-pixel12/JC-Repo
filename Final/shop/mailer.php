<?php
require('mailer/PHPMailer.php');
require('mailer/SMTP.php');
require('mailer/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($to_email, $to_name, $token) {
    $mailer = new PHPMailer(true);
    $mailer->isSMTP();
    $mailer->Host = 'smtp.gmail.com';
    $mailer->SMTPAuth = true;
    $mailer->Username = 'jan3sinigang@gmail.com';
    $mailer->Password = 'yfhahkvanxzepvrf';
    $mailer->SMTPSecure = 'tls';
    $mailer->Port = 587;
    $mailer->isHTML(true);

    $confirm_link = 'http://localhost/jeborines/Final/shop/confirm.php?token=' . rawurlencode($token);
    $mailer->setFrom('no-reply@example.com', 'TrailBlazers Music');
    $mailer->addAddress($to_email, $to_name);
    $mailer->Subject = 'Confirm Your Email Address';
    $mailer->Body = sprintf(
        '<p>Dear <strong>%s</strong></p>'
        . '<p>Thank you for registering with TrailBlazers Music. To complete your registration, please confirm your email address by clicking the link below:</p>'
        . '<p><a href="%s" style="padding:10px 20px; margin-top:20px; margin-bottom:10px; background:#0f7f31; color:#ffffff; text-decoration:none; border-radius:5px;">Confirm Registration</a></p>'
        . '<p>If the button above does not work, please copy and paste the following link into your web browser:</p>'
        . '<p><a href="%s">%s</a></p>'
        . '<p>If you did not register for TrailBlazers Music, please ignore this email.</p>'
        . '<p>Sincerely,<br>The TrailBlazers Music Team</p>',
        htmlspecialchars($to_name, ENT_QUOTES, 'UTF-8'),
        htmlspecialchars($confirm_link, ENT_QUOTES, 'UTF-8'),
        htmlspecialchars($confirm_link, ENT_QUOTES, 'UTF-8'),
        htmlspecialchars($confirm_link, ENT_QUOTES, 'UTF-8')
    );

    $mailer->send();
}
?>

