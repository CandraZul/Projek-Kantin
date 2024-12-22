<?php
session_start();

// If no orders exist, display a message
if (empty($_SESSION['order_history'])) {
    echo "<p>Belum ada riwayat pesanan.</p>";
} else {
    echo "<h2>Riwayat Pesanan</h2>";

    foreach ($_SESSION['order_history'] as $order) {
        echo "<div class='order'>";
        echo "<p><strong>ID Pesanan:</strong> " . $order['order_id'] . "</p>";
        echo "<p><strong>ID Pembeli:</strong> " . $order['buyer_id'] . "</p>";
        echo "<p><strong>Metode Pengiriman:</strong> " . ucfirst($order['delivery_option']) . "</p>";
        echo "<p><strong>Status:</strong> " . ucfirst($order['status']) . "</p>";
        echo "<p><strong>Total Harga:</strong> Rp " . number_format($order['total'], 0, ',', '.') . "</p>";
        echo "<p><strong>Tanggal Pesanan:</strong> " . $order['created_at'] . "</p>";

        echo "<h3>Detail Pesanan:</h3>";
        echo "<ul>";

        foreach ($order['items'] as $item) {
            echo "<li>" . htmlspecialchars($item['name']) . " - Rp " . number_format($item['price'], 0, ',', '.') . " x " . $item['quantity'] . " = Rp " . number_format($item['price'] * $item['quantity'], 0, ',', '.') . "</li>";
        }

        echo "</ul>";
        echo "</div><hr>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
</head>
<body>
    <!-- Displaying order history content above -->
</body>
</html>
