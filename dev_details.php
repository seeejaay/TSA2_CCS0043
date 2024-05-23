<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Device Details</title>
</head>
<body>
    <h1>Device Details</h1>
    <?php if (!empty($_SESSION['devices'])): ?>
        <ul>
            <?php foreach ($_SESSION['devices'] as $id => $device): ?>
                <li>
                    <p>Name: <?php echo $device['name']; ?></p>
                    <p>Price: <?php echo $device['price']; ?></p>
                    <p>Description: <?php echo $device['description']; ?></p>
                    <p>Quantity: <?php echo $device['quantity']; ?></p>
                    <a href="view_dev.php">Back to Devices</a>
                    <a href="index.php">Back to Home</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No devices available.</p>
    <?php endif; ?>
</body>
</html>
