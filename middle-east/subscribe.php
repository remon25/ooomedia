<?php
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $to = 'Wesam.Mardini@ooomedia.de'; 
        $subject = 'اشتراك في النشرة الإخبارية الجديدة';
        $message = "قام مستخدم جديد بالاشتراك في النشرة الإخبارية بعنوان البريد الإلكتروني: $email";
        $headers = "من: no-reply@yourdomain.com\r\n";
        $headers .= "رد إلى: $email\r\n";
        $headers .= "نوع المحتوى: نص عادي\r\n";
    
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
