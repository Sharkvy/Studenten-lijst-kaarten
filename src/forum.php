<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./forum.css">
</head>
<body>
<h1>Contact Form</h1>
<div class="forum-container">
<?php
$email = $_GET['email'] ?? '';
?>
<form method="post" action="./send_email.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="email">Email Recipient:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea><br>

        <input type="submit" value="Send">
    </form>
</div>
</body>
</html>