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
    $quantity = $_POST['quantity'];

    $device = [
        'name' => $name,
        'price' => $price,
        'description' => $description,
        'quantity' => $quantity
    ];

    $_SESSION['devices'][] = $device;
    $message = "Device added successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>HJT Electronic Devices Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to HJT Electronic Devices Store</h1>
        </div>
        <div class="navigation">
            <h2>Navigation</h2>
            <div class="options">
                <ul class="option">
                    <li><a href="view_dev.php">View Devices</a></li>
                    <li><a href="pur_dev.php">Purchase Devices</a></li>
                    <li><a href="pur_his.php">View Purchase History</a></li>
                    <li><a href="dev_details.php">View Device Details</a></li>
                </ul>
            </div>
        </div>


        <div class="card">
        <?php if (isset($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <h2>Add Device</h2>
        <form method="post">
            <div class="input-group">
                <label for="name">Name:</label>
                <input type="text" class="input" name="name" id="name" required><br>
            </div>
            <div class="input-group">
                 <label for="price">Price:</label>
                <input type="number" class="input" name="price" id="price" required><br>
             </div>
            <div class="input-group"><label for="description">Description:</label>
                <input type="text"  class="input" name="description" id="description" required><br>
               
            </div>
            <div class="input-group">
                <label for="quantity">Quantity:</label>
                <input type="number"  class="input" name="quantity" id="quantity" required><br>
            
            </div>
           
            <div class="btn-group">
                <button type="submit" name="add" class="btn-submit">Add Device</button>
            </div>
          
        </form>
        </div>
       
        
    </div>
</body>
</html>
