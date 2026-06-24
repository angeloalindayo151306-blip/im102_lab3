<?php
include 'config.php';
require 'auth.php';
requireLogin();


$overall = $conn->query("
    SELECT COUNT(*) AS total_products,
           SUM(stock) AS total_stock,
           SUM(price * stock) AS total_value
    FROM products
")->fetch_assoc();

$category_report = $conn->query("
    SELECT c.name,
           COUNT(p.id) AS products,
           SUM(p.stock) AS total_stock,
           SUM(p.price * p.stock) AS total_value,
           AVG(p.price) AS avg_price
    FROM categories c
    LEFT JOIN products p ON c.id = p.category_id
    GROUP BY c.id, c.name
    ORDER BY total_value DESC
");

$supplier_report = $conn->query("
    SELECT s.name,
           COUNT(p.id) AS products,
           SUM(p.stock) AS total_stock
    FROM suppliers s
    LEFT JOIN products p ON s.id = p.supplier_id
    GROUP BY s.id, s.name
    ORDER BY products DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <?php include 'navbar.php'; ?>

<h2>Inventory Reports</h2>

<div class="cards">
    <div class="card">
        <strong>Total Products</strong>
        <p><?= $overall['total_products'] ?? 0 ?></p>
    </div>
    <div class="card">
        <strong>Total Stock</strong>
        <p><?= $overall['total_stock'] ?? 0 ?></p>
    </div>
    <div class="card">
        <strong>Total Inventory Value</strong>
        <p>₱<?= number_format($overall['total_value'] ?? 0,2) ?></p>
    </div>
</div>

<h3>Per Category</h3>

<table>
<tr>
<th>Category</th>
<th>Products</th>
<th>Total Stock</th>
<th>Total Value</th>
<th>Average Price</th>
</tr>

<?php while($row = $category_report->fetch_assoc()): ?>
<tr>
<td><?= $row['name'] ?></td>
<td><?= $row['products'] ?? 0 ?></td>
<td><?= $row['total_stock'] ?? 0 ?></td>
<td>₱<?= number_format($row['total_value'] ?? 0,2) ?></td>
<td>₱<?= number_format($row['avg_price'] ?? 0,2) ?></td>
</tr>
<?php endwhile; ?>
</table>
<h3>Per Supplier</h3>

<table>
<tr>
<th>Supplier</th>
<th>Products</th>
<th>Total Stock</th>
</tr>

<?php while($row = $supplier_report->fetch_assoc()): ?>
<tr>
<td><?= $row['name'] ?></td>
<td><?= $row['products'] ?? 0 ?></td>
<td><?= $row['total_stock'] ?? 0 ?></td>
</tr>
<?php endwhile; ?>
</table>

</div>

</body>
</html>