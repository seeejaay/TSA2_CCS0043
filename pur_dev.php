<?php
session_start();

$message = null;  // Initialize the message variable

if (isset($_POST['purchase'])) {
    $id = $_POST['device_id'];
    $quantity = $_POST['quantity'];

    if ($quantity <= 0) {
        $message = "Please enter a valid quantity.";
    } elseif (isset($_SESSION['devices'][$id])) {
        $device = $_SESSION['devices'][$id];

        if ($device['quantity'] >= $quantity) {
            $_SESSION['devices'][$id]['quantity'] -= $quantity;

            $total_price = $device['price'] * $quantity;

            $purchase = [
                'name' => $device['name'],
                'quantity' => $quantity,
                'price' => $device['price'],
                'total' => $total_price,
                'timestamp' => date('Y-m-d H:i:s')
            ];
            $_SESSION['purchases'][] = $purchase;
            $message = "Purchase successful! Total price: $total_price";
        } else {
            $message = "Insufficient quantity available.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Purchase Devices</title>
    <script>
        // Function to display the popup message
        function showMessage(message) {
            alert(message);
        }

        // Function to validate quantity input
        function validateQuantity() {
            var quantityInput = document.getElementById('quantity').value;
            if (quantityInput <= 0 || isNaN(quantityInput)) {
                showMessage("Please enter a valid quantity.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Purchase Devices</h1>
    <?php if (isset($message) && $message): ?>
        <script>
            // Call the function to show the message
            showMessage('<?php echo $message; ?>');
        </script>
    <?php endif; ?>
    <?php if (!empty($_SESSION['devices'])): ?>
        <ul>
            <?php foreach ($_SESSION['devices'] as $id => $device): ?>
                <li>
                    <?php echo $device['name']; ?> - Price: <?php echo $device['price']; ?> - Available: <?php echo $device['quantity']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <form method="post" onsubmit="return validateQuantity()">
            <label for="device_id">Select Device:</label>
            <select name="device_id" id="device_id">
                <?php foreach ($_SESSION['devices'] as $id => $device): ?>
                    <option value="<?php echo $id; ?>">
                        <?php echo $device['name']; ?> (Price: <?php echo $device['price']; ?>, Available: <?php echo $device['quantity']; ?>)
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
