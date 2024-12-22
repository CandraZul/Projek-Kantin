<?php
session_start();

// Handle quantity updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_quantity'])) {
        $itemId = $_POST['item_id'];
        $newQuantity = (int)$_POST['quantity'];

        if ($newQuantity > 0) {
            $_SESSION['cart'][$itemId]['quantity'] = $newQuantity;
        } else {
            unset($_SESSION['cart'][$itemId]);
        }
    } elseif (isset($_POST['remove_item'])) {
        $itemId = $_POST['item_id'];
        unset($_SESSION['cart'][$itemId]);
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Calculate total
$total = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <style>
        /* Gaya CSS disesuaikan dari order.php */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #ff8c00;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-links {
            display: flex;
            gap: 2rem;
        }
        .nav-links a {
            color: black;
            text-decoration: none;
            font-weight: bold;
        }
        .login-btn {
            background-color: #ff4500;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
        }
        .cart-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1rem;
        }
        .cart-item {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 1rem;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cart-item .item-details {
            flex-grow: 1;
        }
        .cart-item h3 {
            margin-bottom: 0.5rem;
        }
        .cart-item .quantity-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .quantity-controls button {
            padding: 0.5rem;
            background-color: #ff8c00;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .quantity-controls button:hover {
            background-color: #ff5722;
        }
        .cart-total {
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 1rem;
            text-align: right;
        }
        .checkout-btn {
            display: block;
            text-align: center;
            padding: 1rem;
            background-color: #ff4500;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 2rem;
            font-size: 1.2rem;
        }
        .checkout-btn:hover {
            background-color: #ff5722;
        }
        .empty-cart {
            text-align: center;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-links">
            <a href="order.php">Menu</a>
            <a href="cart.php">Keranjang</a>
            <a href="riwayatOrder.php">Riwayat</a>
        </div>
        <a href="#login" class="login-btn">Login / Register</a>
    </nav>

    <div class="cart-container">
        <h2>Keranjang Belanja</h2>
        
        <?php if (empty($_SESSION['cart'])): ?>
            <div class="empty-cart">
                <p>Keranjang belanja Anda kosong. Silakan tambah item dari menu.</p>
                <a href="order.php" class="checkout-btn">Kembali ke Menu</a>
            </div>
        <?php else: ?>
            <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                <div class="cart-item">
                    <div class="item-details">
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p>Rp <?php echo number_format($item['price'], 0, ',', '.'); ?> x <?php echo $item['quantity']; ?></p>
                    </div>
                    <div class="quantity-controls">
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="item_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="quantity" value="<?php echo $item['quantity'] - 1; ?>">
                            <button type="submit" name="update_quantity">-</button>
                        </form>
                        <span><?php echo $item['quantity']; ?></span>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="item_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="quantity" value="<?php echo $item['quantity'] + 1; ?>">
                            <button type="submit" name="update_quantity">+</button>
                        </form>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="item_id" value="<?php echo $id; ?>">
                            <button type="submit" name="remove_item" class="remove-btn">Hapus</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="cart-total">
                <p>Total: Rp <?php echo number_format($total, 0, ',', '.'); ?></p>
            </div>

            <a href="checkout.php" class="checkout-btn">Checkout</a>
        <?php endif; ?>
    </div>
</body>
</html>
