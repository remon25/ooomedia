<?php
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $to = 'remoomakram1@gmail.com'; 
        $subject = 'New Newsletter Subscription';
        $message = "A new user has subscribed to the newsletter with the email: $email";
        $headers = "From: no-reply@yourdomain.com\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-type: text/plain\r\n";

        if (mail($to, $subject, $message, $headers)) {
            $response['success'] = true;
            $response['message'] = 'Subscription successful.';
        } else {
            $response['message'] = 'Failed to send email.';
        }
    } else {
        $response['message'] = 'Invalid email address.';
    }
}

echo json_encode($response);
?>
