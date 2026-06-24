<?php
include 'config.php';
require_once 'auth.php';
requireAdmin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = (float) $_POST['price'];
    $stock = (int) $_POST['stock'];
    $category_id = (int) $_POST['category_id'];
    $supplier_id = (int) $_POST['supplier_id'];

    if ($name && $price && $stock && $category_id && $supplier_id) {

        $sql = "INSERT INTO products 
                (name, description, price, stock, category_id, supplier_id)
                VALUES 
                ('$name', '$description', $price, $stock, $category_id, $supplier_id)";

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
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container form-container">

<?php include 'navbar.php'; ?>

<h2>Add Product</h2>

<form method="POST">

<label>Name</label>
<input type="text" name="name"
value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>

<label>Description</label>
<textarea name="description"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>

<label>Price</label>
<input type="number" step="0.01" name="price"
value="<?= htmlspecialchars($_POST['price'] ?? '') ?>" required>

<label>Stock</label>
<input type="number" name="stock"
value="<?= htmlspecialchars($_POST['stock'] ?? '') ?>" required>

<label>Category</label>
<select name="category_id" required>
    <option value="">-- Select Category --</option>
    <?php while ($cat = $categories->fetch_assoc()): ?>
        <option value="<?= $cat['id'] ?>"
        <?= (($_POST['category_id'] ?? '') == $cat['id']) ? 'selected' : '' ?>>
        <?= $cat['name'] ?>
        </option>
    <?php endwhile; ?>
</select>

<label>Supplier</label>
<select name="supplier_id" required>
    <option value="">-- Select Supplier --</option>
    <?php while ($sup = $suppliers->fetch_assoc()): ?>
        <option value="<?= $sup['id'] ?>"
        <?= (($_POST['supplier_id'] ?? '') == $sup['id']) ? 'selected' : '' ?>>
        <?= $sup['name'] ?>
        </option>
    <?php endwhile; ?>
</select>

<div class="form-actions">
    <button type="submit">Save Product</button>
    <a href="index.php" class="cancel-btn">Cancel</a>
</div>

</form>

</div>

</body>
</html>