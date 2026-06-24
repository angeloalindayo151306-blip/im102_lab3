<?php
include 'config.php';
require_once 'auth.php';
requireAdmin();

$id = (int) ($_GET['id'] ?? 0);

$product = $conn->query("
    SELECT p.*, c.name AS category
    FROM products p
    JOIN categories c ON p.category_id = c.id
    WHERE p.id = $id
")->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn->query("DELETE FROM products WHERE id = $id");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container form-container">
    <?php include 'navbar.php'; ?>

<h2>Delete Product</h2>

<p><strong>Name:</strong> <?= htmlspecialchars($product['name']) ?></p>
<p><strong>Category:</strong> <?= htmlspecialchars($product['category']) ?></p>
<p><strong>Price:</strong> ₱<?= number_format($product['price'],2) ?></p>
<p><strong>Stock:</strong> <?= $product['stock'] ?></p>

<p style="color:red;"><strong>Are you sure you want to delete this product?</strong></p>

<form method="POST">
    <div class="form-actions">
        <button type="submit">Yes, Delete</button>
        <a href="index.php" class="cancel-btn">Cancel</a>
    </div>
</form>

</div>

</body>
</html>