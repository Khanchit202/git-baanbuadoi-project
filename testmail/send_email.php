<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['name']) && isset($_POST['email'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $header = $_POST['header'];
    $detail = $_POST['detail'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com"; // Corrected typo in SMTP server address
        $mail->SMTPAuth = true;
        $mail->Username = "khanchit3137@gmail.com"; // Make sure the email address is correct
        $mail->Password = "KhanchitBall0958053137Ball"; // Use application-specific password for Gmail
        $mail->Port = 578; // Corrected the port key
        $mail->SMTPSecure = "ssl";

        // Email settings
        $mail->isHTML(true);
        $mail->setFrom($email, $name); // Set the sender's email and name
        $mail->addAddress("recipient@example.com"); // Replace with the recipient's email
        $mail->Subject = $header;
        $mail->Body = $detail;

        if($mail->send()) {
            $response = array('status' => 'success', 'message' => 'Email sent successfully!');
        } else {
            $response = array('status' => 'error', 'message' => 'Email sending failed: ' . $mail->ErrorInfo);
        }

    } catch (Exception $e) {
        $response = array('status' => 'error', 'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
    }

    // Return response in JSON format
    echo json_encode($response);
}
?>
