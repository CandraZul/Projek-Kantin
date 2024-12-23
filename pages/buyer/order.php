<?php
session_start();

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Mengambil data menu makanan dari API
$apiUrl = 'http://localhost/Projek-Kantin/api/foods.php'; // Ganti dengan path yang sesuai
$menuItems = [];

try {
    $response = file_get_contents($apiUrl);
    $decodedResponse = json_decode($response, true);

    if (isset($decodedResponse['status']) && $decodedResponse['status'] === 'sukses' && isset($decodedResponse['data'])) {
        $menuItems = $decodedResponse['data'];
    }
} catch (Exception $e) {
    $menuItems = []; // Gunakan data default kosong jika terjadi kesalahan
}

// Handle POST request untuk menambah item ke keranjang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $itemId = $_POST['item_id'];
    $itemName = $_POST['item_name'];
    $itemPrice = (float)$_POST['item_price'];

    if (isset($_SESSION['cart'][$itemId])) {
        $_SESSION['cart'][$itemId]['quantity']++;
    } else {
        $_SESSION['cart'][$itemId] = [
            'name' => $itemName,
            'price' => $itemPrice,
            'quantity' => 1,
        ];
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Restoran</title>
    <style>
        /* Gaya CSS */
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
        .search-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .search-box {
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 25px;
            background-color: #f0f0f0;
        }
        .menu-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }
        .menu-item {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 1rem;
            text-align: center;
        }
        .menu-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        .menu-item h3 {
            color: #4CAF50;
            margin: 1rem 0;
        }
        .menu-item p {
            color: #666;
            margin-bottom: 1rem;
            min-height: 60px;
        }
        .price {
            color: #4CAF50;
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        .add-to-cart {
            background-color: #ff4500;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .add-to-cart:hover {
            background-color: #ff5722;
        }
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin: 2rem 0;
        }
        .pagination a {
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #666;
        }
        .pagination a.active {
            background-color: #f0f0f0;
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

    <div class="search-container">
        <input type="text" class="search-box" placeholder="Cari Makanan">
    </div>

    <div class="menu-container">
        <?php if (empty($menuItems)): ?>
            <p>Menu tidak tersedia saat ini.</p>
        <?php else: ?>
            <?php foreach ($menuItems as $item): ?>
                <div class="menu-item">
                    <img src="../<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" onerror="this.src='https://via.placeholder.com/300x200'">
                    <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                    <p><?php echo htmlspecialchars($item['description']); ?></p>
                    <div class="price">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></div>
                    <form method="POST">
                        <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['food_id']); ?>">
                        <input type="hidden" name="item_name" value="<?php echo htmlspecialchars($item['name']); ?>">
                        <input type="hidden" name="item_price" value="<?php echo htmlspecialchars($item['price']); ?>">
                        <button type="submit" name="add_to_cart" class="add-to-cart">Tambahkan</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <script>
        document.querySelector('.search-box').addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('.menu-item').forEach(item => {
                const name = item.querySelector('h3').textContent.toLowerCase();
                const description = item.querySelector('p').textContent.toLowerCase();
                if (name.includes(searchTerm) || description.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
