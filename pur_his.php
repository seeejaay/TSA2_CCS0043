<?php
session_start();

// Handle clearing all purchases
if (isset($_POST['clear_all_purchases'])) {
    $_SESSION['purchases'] = [];
    header("Location: pur_his.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Purchase History</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header"><h1>Purchase History</h1></div>
    
    <?php if (!empty($_SESSION['purchases'])): ?>
        <ul>
            <?php 
            $total_cost = 0;
            $total_items = 0;
            foreach ($_SESSION['purchases'] as $purchase): 
                $total_cost += $purchase['total'];
                $total_items += $purchase['quantity'];
            ?>
                <li>
                    <?php echo implode(", ", $purchase); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <p>Total Cost: <?php echo $total_cost; ?></p>
        <p>Total Items Sold: <?php echo $total_items; ?></p>
        <div class="delete-container">
        <form method="post">
            <button type="submit" class="clearBtn"name="clear_all_purchases">Clear All Purchases</button>
        </form>
        </div>
    <?php else: ?>
        <p>No purchases made yet.</p>
    <?php endif; ?>
    <a href="index.php" class="btn-home">Back to Home</a>
    </div>
</body>
</html>
