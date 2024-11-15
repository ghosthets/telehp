<?php
// Sensitive information (Bot Token and Chat ID)
$botToken = "7508621772:AAH50ab4mmymcw_k2c2heOjGjIc93kkSVMs";
$chatId = "5701220208";

// Check if form data is received via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Format the message text to send to Telegram
    $text = "New Message from Website:\n\n";
    $text .= "Name: $name\n";
    $text .= "Email: $email\n";
    $text .= "Message: $message";

    // Send the message to Telegram using the Telegram API
    $url = "https://api.telegram.org/bot$botToken/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $text
    ];

    // Use cURL to send data to Telegram
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    // Check if the message was sent successfully
    if ($response) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }
} else {
    echo "Invalid request.";
}
?>
