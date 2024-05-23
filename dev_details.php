<?php
session_start();

if (isset($_GET['id']) && isset($_SESSION['devices'][$_GET['id']])) {
    $device = $_SESSION['devices'][$_GET['id']];
} else {
    $device = null;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Device Details</title>
</head>
<body>
    <h1>Device Details</h1>
    <?php if ($device): ?>
        <p>Name: <?php echo $device['name']; ?></p>
        <p>Price: <?php echo $device['price']; ?></p>
        <p>Description: <?php echo $device['description']; ?></p>
    <?php else: ?>
        <p>Device not found.</p>
    <?php endif; ?>
    <a href="view_dev.php">Back to Devices</a>
    <a href="index.php">Back to Home</a>
</body>
</html>
