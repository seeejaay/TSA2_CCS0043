<?php
session_start();

// Handle device deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    unset($_SESSION['devices'][$id]);
    header("Location: view_devices.php");
    exit();
}

// Handle clearing all devices
if (isset($_POST['clear_all_devices'])) {
    $_SESSION['devices'] = [];
    header("Location: view_devices.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Devices</title>
</head>
<body>
    <h1>Available Devices</h1>
    <?php if (!empty($_SESSION['devices'])): ?>
        <ul>
            <?php foreach ($_SESSION['devices'] as $id => $device): ?>
                <li>
                    <?php echo implode(", ", $device); ?> 
                    <a href="view_devices.php?delete=<?php echo $id; ?>">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <form method="post">
            <button type="submit" name="clear_all_devices">Clear All Devices</button>
        </form>
    <?php else: ?>
        <p>No devices available.</p>
    <?php endif; ?>
    <a href="index.php">Back to Home</a>
</body>
</html>
