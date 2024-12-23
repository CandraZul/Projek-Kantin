<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../login.php");
    exit;
} else if ($_SESSION["user_type"] != "buyer") {
    echo "Hanya bisa diakses pembeli";
    exit;
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

        table th,
        table td {
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <nav class="navbar">
        <div class="nav-links">
            <a href="order.php">Menu</a>
            <a href="cart.php">Keranjang</a>
            <a href="riwayatOrder.php">Riwayat</a>
        </div>
        <a href="../../api/auth/logout.php" class="login-btn" onclick="return confirm('Apakah Anda yakin akan logout?')">Logout</a>
    </nav>

    <div class="container">
        <h2>Riwayat Pesanan</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Total Harga</th>
                    <th>Tanggal Pesanan</th>
                </tr>
            </thead>
            <tbody id="orderTableBody">

            </tbody>
        </table>
    </div>
    <script>
        var userId = <?php echo isset($_SESSION['user_id']) ? json_encode($_SESSION['user_id']) : 'null'; ?>;

        $(document).ready(function() {
            $.ajax({
                url: '../../api/order.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === "sukses") {
                        let orders = response.data;
                        console.log(orders);

                        let filteredOrders = orders.filter(function(order) {
                            return order.buyer_id === userId;
                        });

                        let tableBody = $('#orderTableBody');
                        tableBody.empty(); // Clear existing table rows

                        // Loop through each filtered order and create a row
                        filteredOrders.forEach(function(order) {
                            console.log(order)
                            let statusColor;
                            switch (order.status) {
                                case 'preparing':
                                    statusClass = 'status processing';
                                    break;
                                case 'delivery':
                                    statusClass = 'status processing';
                                    break;
                                case 'ready':
                                    statusClass = 'status processing';
                                    break;
                                case 'delivered':
                                    statusClass = 'status completed';
                                    break;
                                case 'paid':
                                    statusClass = 'status completed';
                                    break;
                                case 'cancelled':
                                    statusClass = 'status cancelled';
                                    break;
                                default:
                                    statusClass = 'status'; 
                            }

                            let row = `
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${order.order_id}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${order.delivery_option}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm ${statusClass}">${order.status}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp ${parseFloat(order.total_price).toLocaleString()}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${order.created_at}</td>
                                </tr>
                            `;
                            tableBody.append(row);
                        });
                    } else {
                        alert("Failed to fetch orders");
                    }
                },
                error: function() {
                    alert("Error in fetching data");
                }
            });
        });
    </script>
</body>

</html>