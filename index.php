<?php
session_start();

// Initialize device inventory and purchase history if not already
if (!isset($_SESSION['devices'])) {
    $_SESSION['devices'] = [];
}

if (!isset($_SESSION['purchases'])) {
    $_SESSION['purchases'] = [];
}

// Handle adding a new device
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $device = [
        'name' => $name,
        'price' => $price,
        'description' => $description
    ];

    $_SESSION['devices'][] = $device;
    $message = "Device added successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>HJT Electronic Devices Store</title>
</head>
<body>
    <h1>Welcome to HJT Electronic Devices Store</h1>
    <?php if (isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <h2>Add Device</h2>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required><br>
        <label for="description">Description:</label>
        <input type="text" name="description" id="description" required><br>
        <button type="submit" name="add">Add Device</button>
    </form>
    <h2>Navigation</h2>
    <ul>
        <li><a href="view_dev.php">View Devices</a></li>
        <li><a href="pur_dev.php">Purchase Devices</a></li>
        <li><a href="pur_his.php">View Purchase History</a></li>
        <li><a href="dev_details.php">View Device Details</a></li>
    </ul>
</body>
</html>
