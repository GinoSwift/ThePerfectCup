<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

include_once __DIR__ . '/../vendor/PhpMailer/PhpMailer/src/PHPMailer.php';
include_once __DIR__ . '/../vendor/PhpMailer/PhpMailer/src/SMTP.php';
include_once __DIR__ . '/../vendor/PhpMailer/PhpMailer/src/Exception.php';
include_once __DIR__ . '/../model/authentication.php';

class AuthenticationController extends Authentication
{
    public function MemberLists()
    {
        return $this->getMemberLists();
    }

    public function getMemberByID($id)
    {
        return $this->getMembersByID($id);
    }

    public function sendMail($email)
    {
        $otp = rand(1000, 9999);

        $mailer = new PHPMailer(true);

        //Server settings

        $mailer->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug
        $mailer->isSMTP();
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->SMTPSecure = 'tls';
        $mailer->Port = 587;

        $mailer->Username = "phillipbank2004@gmail.com";
        $mailer->Password = "asea uuzo obsw unzp";

        $mailer->setFrom("phillipbank2004@gmail.com", "The Perfect Cup");
        $mailer->addAddress($email);

        $mailer->IsHTML(true);
        $mailer->Subject = "Your account registration is in progress.";
        $mailer->Body = 'Your OTP code is ::  ' . $otp . '';

        if ($mailer->send()) {
            return $otp;
        }
    }
}
