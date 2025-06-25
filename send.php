<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Validate data
    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        echo "Invalid input.";
        exit;
    }

    // Email settings
    $to = "supplinexsolutionsltd@gmail.com";
    $subject = "New Contact Form Message from $name";
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    $headers = "From: $name <$email>";

    // Send email
    if (mail($to, $subject, $email_content, $headers)) {
        echo "<script>alert('Message sent successfully. Thank you!'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Message failed to send. Please try again.'); window.location.href='contact.html';</script>";
    }
} else {
    // Not a POST request
    http_response_code(403);
    echo "There was a problem with your submission.";
}
?>
