<?php
// Include PHPMailer Autoload
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database Connection
$db_hostname = "127.0.0.1";
$db_username = "root";
$db_password = "";
$db_name = "tour";

$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
if (!$conn) {
    echo "Connection Failed:", mysqli_connect_error();
    exit;
}

// Form Data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Insert into Database
$sql = "INSERT INTO contact (name, email, phone, subject, message) VALUES ('$name', '$email', '$phone', '$subject', '$message')";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Error: ", mysqli_error($conn);
    exit;
}

$from = $_REQUEST['email'] ?? '';
$name = $_REQUEST['name'] ?? '';
$subject = $_REQUEST['subject'] ?? '';
$message = $_REQUEST['message'] ?? '';

$mail = new PHPMailer(true);
try {

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls'; // Set to 'tls'
    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'kushwahasujeet222@gmail.com';
    $mail->Password = 'qpnv wmoi okmy qrpb';
    $mail->Port = 587;

    // Recipients
    $mail->setFrom($from, $name);
    $mail->addAddress('sujeet.mitmeerut@gmail.com', 'new user');

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = "Name: $name<br>Email: $email<br>Phone: $phone<br>Message: $message";

    $mail->send();
    echo "Email sent successfully";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

mysqli_close($conn);
?>
