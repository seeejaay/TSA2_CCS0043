<?php
session_start();

$message = null;  // Initialize the message variable

// Handle device deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    unset($_SESSION['devices'][$id]);
    $message = "Device deleted successfully!";
    // Use JavaScript to show the message and redirect back to index.php (home)
    echo "<script>
            alert('$message');
            window.location.href='view_dev.php';
          </script>";
    exit();
}

// Handle clearing all devices
if (isset($_POST['clear_all_devices'])) {
    $_SESSION['devices'] = [];
    $message = "All devices cleared!";
    // Use JavaScript to show the message and redirect back to index.php (home)
    echo "<script>
            alert('$message');
            window.location.href='view_dev.php';
          </script>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Devices</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Function to display the popup message
        function showMessage(message) {
            alert(message);
        }

        // Function to confirm device deletion
        function confirmDelete(url) {
            if (confirm("Are you sure you want to delete this device?")) {
                window.location.href = url;
            }
        }

        // Function to confirm clearing all devices
        function confirmClearAll() {
            if (confirm("Are you sure you want to clear all devices?")) {
                document.getElementById('clearAllForm').submit();
            }
        }
    </script>
</head>
<body>
    <div class="container">
    <h1>Available Devices</h1>
    <?php if (!empty($_SESSION['devices'])): ?>
        <ul class="avail-device">
            <?php foreach ($_SESSION['devices'] as $id => $device): ?>
                <li class="devices">
                    <div class="details"><?php echo implode(", ", $device); ?> </div>
                    
                    <div class="delete">
                    <a href="#"  class="delete-btn"onclick="confirmDelete('view_dev.php?delete=<?php echo $id; ?>')">Delete</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <form method="post" id="clearAllForm">
            <button type="button" onclick="confirmClearAll()">Clear All Devices</button>
            <input type="hidden" name="clear_all_devices">
        </form>
    <?php else: ?>
        <p>No devices available.</p>
    <?php endif; ?>
    <a href="index.php">Back to Home</a>
    </div>
</body>
</html>
