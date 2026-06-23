<?php
require_once 'config.php';
require_once 'auth.php';
requireLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">

    </head>
<body>
<div class="container">
    <h3>Welcome. <?php echo getUserName(); ?>!</h3>

    <p>You are logged in.</p>

    <a href="logout.php">Logout</a>
    </div>
</body>
</html>
