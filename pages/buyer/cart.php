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
            max-width: 800px;
            margin: 2rem auto;
            padding: 1rem;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .item-details {
            flex-grow: 1;
            margin: 0 1rem;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quantity-controls input {
            width: 50px;
            padding: 0.3rem;
            text-align: center;
        }

        .quantity-controls button {
            padding: 0.3rem 0.8rem;
            border: none;
            background-color: #ff4500;
            color: white;
            border-radius: 3px;
            cursor: pointer;
        }

        .remove-btn {
            background-color: #ff4444;
            color: white;
            border: none;
            padding: 0.5rem;
            border-radius: 3px;
            cursor: pointer;
        }

        .cart-total {
            margin-top: 2rem;
            text-align: right;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .checkout-btn {
            display: block;
            width: 200px;
            margin: 2rem 0 0 auto;
            padding: 1rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .empty-cart {
            text-align: center;
            padding: 2rem;
            color: #666;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-links">
            <a href="order.php">Menu</a>
            <a href="cart.php">Keranjang</a>
        </div>
        <a href="#login" class="login-btn">Login / Register</a>
    </nav>

    <div class="cart-container">
        <h2>Keranjang Belanja</h2>
        
        <?php if (empty($_SESSION['cart'])): ?>
            <div class="empty-cart">
                <p>Keranjang belanja Anda kosong</p>
            </div>
        <?php else: ?>
            <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                <div class="cart-item">
                    <div class="item-details">
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p>Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
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
                Total: Rp <?php echo number_format($total, 0, ',', '.'); ?>
            </div>
            <a href="#checkout" class="checkout-btn">Checkout</a>
        <?php endif; ?>
    </div>
</body>
</html>
