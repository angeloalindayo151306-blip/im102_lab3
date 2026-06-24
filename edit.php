<?php
include 'config.php';
require 'auth.php';
requireAdmin();

$id = (int) ($_GET['id'] ?? 0);

$product = $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = (float) $_POST['price'];
    $stock = (int) $_POST['stock'];
    $category_id = (int) $_POST['category_id'];
    $supplier_id = (int) $_POST['supplier_id'];

    if ($name && $price && $stock && $category_id && $supplier_id) {

        $sql = "UPDATE products SET
                name='$name',
                description='$description',
                price=$price,
                stock=$stock,
                category_id=$category_id,
                supplier_id=$supplier_id
                WHERE id=$id";

        $conn->query($sql);
        header("Location: index.php");
        exit;
    }
}

$categories = $conn->query("SELECT id, name FROM categories ORDER BY name");
$suppliers = $conn->query("SELECT id, name FROM suppliers ORDER BY name");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container form-container">
    <?php include 'navbar.php'; ?>

<h2>Edit Product</h2>

<form method="POST">

<label>Name</label>
<input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

<label>Description</label>
<textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea>

<label>Price</label>
<input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required>

<label>Stock</label>
<input type="number" name="stock" value="<?= $product['stock'] ?>" required>

<label>Category</label>
<select name="category_id" required>
    <option value="">-- Select Category --</option>
    <?php while ($cat = $categories->fetch_assoc()): ?>
        <option value="<?= $cat['id'] ?>"
            <?= $cat['id'] == $product['category_id'] ? 'selected' : '' ?>>
            <?= $cat['name'] ?>
        </option>
    <?php endwhile; ?>
</select>

<label>Supplier</label>
<select name="supplier_id" required>
    <option value="">-- Select Supplier --</option>
    <?php while ($sup = $suppliers->fetch_assoc()): ?>
        <option value="<?= $sup['id'] ?>"
            <?= $sup['id'] == $product['supplier_id'] ? 'selected' : '' ?>>
            <?= $sup['name'] ?>
        </option>
    <?php endwhile; ?>
</select>

<div class="form-actions">
    <button type="submit">Update Product</button>
    <a href="index.php" class="cancel-btn">Cancel</a>
</div>

</form>

</div>

</body>
</html>