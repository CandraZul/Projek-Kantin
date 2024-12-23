<?php
session_start();

// Jika tidak ada riwayat pesanan
if (empty($_SESSION['order_history'])) {
    $order_history = [];
} else {
    $order_history = $_SESSION['order_history'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <style>
        /* Gaya CSS diadaptasi */
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
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 0.8rem;
            text-align: left;
        }
        table th {
            background-color: #ff8c00;
            color: white;
        }
        .status {
            display: inline-block;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            font-weight: bold;
            border-radius: 5px;
            color: white;
        }
        .status.pending {
            background-color: #ffcc00;
        }
        .status.processing {
            background-color: #00bcd4;
        }
        .status.completed {
            background-color: #4caf50;
        }
        .status.cancelled {
            background-color: #f44336;
        }
        .empty-order {
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

    <div class="container">
        <h2>Riwayat Pesanan</h2>

        <?php if (empty($order_history)): ?>
            <div class="empty-order">
                <p>Belum ada riwayat pesanan.</p>
                <a href="order.php" class="login-btn">Kembali ke Menu</a>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama Pembeli</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Tanggal Pesanan</th>
                        <th>Detail Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_history as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                            <td><?php echo htmlspecialchars($order['buyer_name']); ?></td>
                            <td><?php echo ucfirst($order['delivery_option']); ?></td>
                            <td>
                                <span class="status <?php echo htmlspecialchars($order['status']); ?>">
                                    <?php echo ucfirst($order['status']); ?>
                                </span>
                            </td>
                            <td>Rp <?php echo number_format($order['total'], 0, ',', '.'); ?></td>
                            <td><?php echo $order['created_at']; ?></td>
                            <td>
                                <ul>
                                    <?php foreach ($order['items'] as $item): ?>
                                        <li>
                                            <?php echo htmlspecialchars($item['name']); ?> - 
                                            Rp <?php echo number_format($item['price'], 0, ',', '.'); ?> 
                                            x <?php echo $item['quantity']; ?> = 
                                            Rp <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
