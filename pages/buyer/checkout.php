<?php
session_start();

// Jika belum ada item di keranjang, redirect ke cart.php
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

// Hitung total
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
    <title>Checkout</title>
    <style>
        /* CSS styles disesuaikan dari cart.php */
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

        .checkout-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1rem;
        }

        .checkout-container h2 {
            margin-bottom: 1rem;
        }

        .cart-items {
            margin-bottom: 2rem;
        }

        .cart-item {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-total {
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 1rem;
            text-align: right;
        }

        .form-section label {
            font-weight: bold;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-section input,
        .form-section select {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
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
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="nav-links">
            <a href="order.php">Menu</a>
            <a href="cart.php">Keranjang</a>
            <a href="riwayatOrder.php">Riwayat</a>
        </div>
    </nav>

    <div class="checkout-container">
        <h2>Checkout</h2>

        <?php if (empty($_SESSION['cart'])): ?>
            <div class="empty-cart">
                <p>Keranjang Anda kosong. Silakan tambahkan item ke keranjang terlebih dahulu.</p>
                <a href="order.php" class="checkout-btn">Kembali ke Menu</a>
            </div>
        <?php else: ?>
            <div class="cart-items">
                <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                    <div class="cart-item">
                        <div>
                            <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                            <p>Rp <?php echo number_format($item['price'], 0, ',', '.'); ?> x <?php echo $item['quantity']; ?></p>
                        </div>
                        <p>Total: Rp <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cart-total">
                <p>Total: Rp <?php echo number_format($total, 0, ',', '.'); ?></p>
            </div>

            <form id="menuForm" method="POST" class="form-section">

                <label for="delivery_option">Metode Pengiriman</label>
                <select id="delivery_option" name="delivery_option" required>
                    <option value="pickup">Ambil di Tempat</option>
                    <option value="delivery">Pengiriman</option>
                </select>

                <button type="submit" class="checkout-btn">Konfirmasi Pesanan</button>
            </form>
        <?php endif; ?>
    </div>
    <script>
        var userId = <?php echo isset($_SESSION['user_id']) ? json_encode($_SESSION['user_id']) : 'null'; ?>;
        var cart = <?php echo json_encode($_SESSION['cart']); ?>;
        var totalPrice = 0;

        // Membuat array items dengan format yang sesuai untuk dikirim ke API
        var items = Object.keys(cart).map(function(itemId) {
            var item = cart[itemId];
            var total = item.price * item.quantity;
            totalPrice += total; // Menghitung total harga keseluruhan

            return {
                food_id: itemId,
                quantity: item.quantity,
                total: total
            };
        });

        document.getElementById("menuForm").addEventListener("submit", function(event) {
            event.preventDefault();
            var data = {
                buyer_id: userId,
                delivery_option: document.getElementById('delivery_option').value,
                items: items, // Mengirimkan data items yang telah diubah formatnya
                total_price: totalPrice
            };

            fetch("../../api/order.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    try {
                        const jsonData = JSON.parse(data);
                        if (jsonData.status === "sukses") {
                            alert("Menu berhasil ditambahkan!");
                            <?php
                                unset($_SESSION['cart']);
                            ?>
                            window.location.href = "riwayatOrder.php";
                        } else {
                            alert("Terjadi kesalahan: " + jsonData.message);
                        }
                    } catch (error) {
                        alert("Error parsing JSON: " + error.message);
                    }
                })
                .catch(error => {
                    alert("Terjadi kesalahan: " + error.message);
                });
        });
    </script>

</body>

</html>