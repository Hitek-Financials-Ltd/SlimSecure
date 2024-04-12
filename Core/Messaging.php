<?php

namespace Hitek\Slimez\Payments\Core;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Hitek\Slimez\Payments\Configs\Env;
use Hitek\Slimez\Payments\Core\HttpVerbs;

class Messaging
{
    /**
     * @var use this method to send email notifcations
     */
    public static function sendEmail(
        string $sender,
        string $companyName,
        array $recipients,
        string $message,
        string $title,
        array $attachments = []
    ) {
        $mail = new PHPMailer(true);
    
        try {
            // Server settings
            // Uncomment the next line to enable debug output to see SMTP transaction details
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    
            $formattedMessage = '<html>';
            $formattedMessage .= '<head>';
            $formattedMessage .= '<meta charset="UTF-8">';
            $formattedMessage .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
            $formattedMessage .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
            $formattedMessage .= '</head>';
            $formattedMessage .= "<body>";
            $formattedMessage .= "<main style ='border: 1px solid #f7f7f7; border-radius: 5px;background-color: #f9f9f9'>{$message}</main>";
            $formattedMessage .= "</body>";
            $formattedMessage .= "</html>";
    
            $mail->isSMTP();
            $mail->Host       = Env::SMTP_SERVER;
            $mail->SMTPAuth   = true;
            $mail->Username   = $sender; // Often, this is an email
            $mail->Password   = Env::SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = Env::SMTP_PORT;
    
            // Sender
            $mail->setFrom($sender, $companyName);
    
            // Recipients
            $mail->addAddress($recipients[0]); // Add the first recipient to "To"
    
            // Add the rest of the recipients to "Bcc"
            for ($i = 1; $i < count($recipients); $i++) {
                $mail->addBCC($recipients[$i]);
            }
    
            $mail->addReplyTo($sender, 'Information');
    
            if (!empty($attachments)) {
                // Attachments
                foreach ($attachments as $attachment) {
                    $mail->addAttachment($attachment);
                }
            }
    
            // Content
            $mail->isHTML(true);
            $mail->Subject = $title;
            $mail->Body    = $formattedMessage;
    
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }    
}
