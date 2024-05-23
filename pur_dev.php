<?php
session_start();

if (isset($_POST['purchase'])) {
    $id = $_POST['device_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['devices'][$id])) {
        $device = $_SESSION['devices'][$id];
        $purchase = [
            'name' => $device['name'],
            'quantity' => $quantity,
            'price' => $device['price'],
            'total' => $device['price'] * $quantity
        ];
        $_SESSION['purchases'][] = $purchase;
    }
    header("Location: purchase_devices.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Purchase Devices</title>
</head>
<body>
    <h1>Purchase Devices</h1>
    <?php if (!empty($_SESSION['devices'])): ?>
        <form method="post">
            <label for="device_id">Select Device:</label>
            <select name="device_id" id="device_id">
                <?php foreach ($_SESSION['devices'] as $id => $device): ?>
                    <option value="<?php echo $id; ?>">
                        <?php echo $device['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" required><br>
            <button type="submit" name="purchase">Purchase</button>
        </form>
    <?php else: ?>
        <p>No devices available for purchase.</p>
    <?php endif; ?>
    <a href="index.php">Back to Home</a>
</body>
</html>
