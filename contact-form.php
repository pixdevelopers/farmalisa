<?php
require_once 'mailer/PHPMailerAutoload.php';

$mail = new PHPMailer();

$content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">
    <title>Farmalisa | Email</title>
    <style type="text/css">
    body {
        font-family: sans-serif;
    }
    </style>
</head>

<body bgcolor="#fff">
        <table bgcolor="#f8f8f8"  cellpadding="0" cellspacing="0"  style="max-width: 600px; margin: 0 auto;">
        <tr bgcolor="#FFF">
            <td>
                <img src="http://farmalisa.com/email-images/farmalisa.png" style="display: block; margin: 100px auto 15px;" />
            </td>
        </tr>

            <tr>
                <td>
                    <img src="http://farmalisa.com/email-images/email.jpg" style="display: block; width: 100%;" />
                </td>
            </tr>
            <tr>
                <td style="padding:35px 40px 60px;">
                    <p style="margin:5px auto; color: #52b5cd; font-size: 29px;">Hi <strong>Farshid Jahangiri</strong>,</p>
                    <p style="margin:10px auto; color: #363636; font-size: 21px;">You have a new message at <strong>Farmalisa.com</strong></p>
                    <div style="background: #fff; box-shadow: #e5e5e5 1px 2px 0; padding: 0 25px; height: 70px; margin:50px auto 5px;">
                        <img src="http://farmalisa.com/email-images/icon-1.png" style="float: left; margin: 22px 17px 0 0;" />
                        <p style="margin:0 auto; line-height: 70px; color: #8f8f8f;">From: <span style="color: #333; margin-left:10px;"><b>**name**</b> (**email**)</span></p>
                    </div>
                    <div style="background: #fff; box-shadow: #e5e5e5 1px 2px 0; padding: 0 25px; height: 70px; margin:5px auto;">
                        <img src="http://farmalisa.com/email-images/icon-2.png" style="float: left; margin: 22px 17px 0 0;" />
                        <p style="margin:0 auto; line-height: 70px; color: #8f8f8f;">Date and Time: <span style="color: #333; margin-left:10px;">**date**</span></p>
                    </div>
                    <div style="background: #fff; box-shadow: #e5e5e5 1px 2px 0; padding: 0 25px 30px; margin:5px auto;">
                        <img src="http://farmalisa.com/email-images/icon-3.png" style="float: left; margin: 22px 17px 0 0;" />
                        <p style="margin:0 auto; line-height: 70px; color: #8f8f8f;">Message:</p>
                        <p style="color: #333; text-align: justify; line-height: 25px; font-size: 15px; margin: -15px 10px 0 40px;">
                            **message**
                        </p>
                    </div>
                </td>
            </tr>
        </table>
        <p style="color: #999; font-size: 14px; text-align: center; line-height: 24px; margin: 30px auto 0;">Farmalisa © Orucreis Mah., Vadi Cd., No: 142/A, GiyimkentSitesi., <br> Esenler, 34235, Istanbul, Türkiye</p>
        <p style="color: #999; font-size:14px; text-align: center; margin: 5px auto 60px;">+90 (212) 438 7120 , +90 534 393 4120</p>
</body>

</html>
';

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])){
    $content = str_replace('**name**',$_POST['name'],$content);
    $content = str_replace('**email**',$_POST['email'],$content);
    $content = str_replace('**message**',$_POST['message'],$content);
    $content = str_replace('**date**', Date('d M Y | H:i'),$content);

    $mail->CharSet = 'UTF-8';
    $mail->From = $_POST['email'];
    $mail->FromName = 'Farmalisa Support';
    $mail->AddAddress('info@farmalisa.com');
    $mail->isHTML(true);
    $mail->Subject = 'You have a new message';
    $mail->addReplyTo($_POST['email'], $_POST['name']);
    $mail->Body = $content;


    if(!$mail->send()) {
        $data = false;
        echo json_encode($data);
        exit;
    }
else{
$data = true;
        echo json_encode($data);
}
}
else    header( 'Location: /') ;

