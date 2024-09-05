<?php
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['mail'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $to = 'remoomakram1@gmail.com';
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-type: text/html\r\n";

    $email_body = "<html><body>";
    $email_body .= "<h2>Contact Form Submission</h2>";
    $email_body .= "<p><strong>Name:</strong> $name</p>";
    $email_body .= "<p><strong>Email:</strong> $email</p>";
    $email_body .= "<p><strong>Subject:</strong> $subject</p>";
    $email_body .= "<p><strong>Message:</strong></p>";
    $email_body .= "<p>$message</p>";
    $email_body .= "</body></html>";

    if (mail($to, $subject, $email_body, $headers)) {
        $response['success'] = true;
        $response['message'] = 'Email sent successfully.';
    } else {
        $response['message'] = 'Failed to send email.';
    }
}

echo json_encode($response);
?>
