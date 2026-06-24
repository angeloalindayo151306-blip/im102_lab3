<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$username = $_SESSION['username'] ?? 'Guest';
$role = $_SESSION['role'] ?? 'viewer';
?>

<div class="navbar">
    <div class="nav-left">
        <a href="index.php" class="logo">Inventory System</a>
    </div>

    <div class="nav-center">

        <a href="index.php"
           class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
            Products
        </a>

        <?php if ($role === 'admin' || $role === 'staff'): ?>
            <a href="report.php"
               class="<?= basename($_SERVER['PHP_SELF']) == 'report.php' ? 'active' : '' ?>">
                Reports
            </a>
        <?php endif; ?>

        <?php if ($role === 'admin'): ?>
            <a href="add.php"
               class="nav-btn <?= basename($_SERVER['PHP_SELF']) == 'add.php' ? 'active-btn' : '' ?>">
                + Add Product
            </a>
        <?php endif; ?>

    </div>

    <div class="nav-user">
        <div class="user-avatar">
            <?= strtoupper(substr($username, 0, 1)) ?>
        </div>
        <span class="user-name">
            <?= htmlspecialchars($username) ?> (<?= ucfirst($role) ?>)
        </span>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</div>