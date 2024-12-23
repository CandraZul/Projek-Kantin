<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: ../../login.php");
        exit;
    }else if($_SESSION["user_type"] != "seller"){
        echo "Hanya bisa diakses penjual";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Order - Kantin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-4">
                <div class="flex items-center mb-8">
                    <a href="dashboard.php" class="flex items-center">
                    <h1 class="m-4 text-uppercase" style="color:#8B4513; font-size: 2rem; display: flex; align-items: center; gap: 10px; margin-top: -5px;">
                                <i class="fa fa-utensils" style="font-size: 2rem;"></i>
                                <span style="font-weight: bold;">KANTIN</span>
                            </h1>
                    </a>
                </div>
                
                <!-- Navigation Menu -->
                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="dashboard.php" class="flex items-center text-gray-600 p-2 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-home mr-3"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="aturMenu.php" class="flex items-center text-gray-600 p-2 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-utensils mr-3"></i>
                                <span>Atur Menu</span>
                            </a>
                        </li>
                        <li>
                            <a href="daftarOrder.php" class="flex items-center text-gray-600 p-2 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-clipboard-list mr-3"></i>
                                <span>Daftar Order</span>
                            </a>
                        </li>
                        <li>
                            <a href="riwayatOrder.php" class="flex items-center text-pink-500 p-2 rounded-lg bg-pink-50">
                                <i class="fas fa-history mr-3"></i>
                                <span>Riwayat Order</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                
                <!-- Logout Button -->
                <div class="absolute bottom-4 w-56">
                    <a href="../../api/auth/logout.php" onclick="return confirm('Apakah Anda yakin akan logout?')" class="flex items-center text-gray-600 p-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto" style="background-color: #FFF3E9;">
            <!-- Top Navigation -->
            <div class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-8 py-4">
                    <h2 class="text-xl font-semibold">Riwayat Order</h2>
                    <div class="flex items-center space-x-4">
                        <a href="profile.php" class="flex items-center">
                            <span class="mr-2"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                            <img src="../../assets/img/icon/guest.png" alt="Admin" class="h-8 w-8 rounded-full">
                        </a>
                    </div>
                </div>
            </div>

            <!-- Order History Table -->
            <div class="p-8">
                <div class="bg-white rounded-lg shadow">
                <table class="w-full" id="orderTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu Item</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody id="orderTableBody" class="bg-white divide-y divide-gray-200">
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <div class="flex-1 flex justify-between items-center">
                            <p class="text-sm text-gray-700">
                                per page
                            </p>
                            <div class="flex space-x-2">
                                <button class="relative inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Previous
                                </button>
                                <span class="text-gray-600">1/1</span>
                                <button class="relative inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '../../api/order.php?all_orders=true',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if(response.status === "sukses") {
                        let orders = response.data;
                        console.log(orders);

                        // Filter orders to only include 'cancelled' and 'paid' statuses
                        let filteredOrders = orders.filter(function(order) {
                            return order.order.status === 'cancelled' || order.order.status === 'paid';
                        });

                        let tableBody = $('#orderTableBody');
                        tableBody.empty();  // Clear existing table rows

                        // Loop through each filtered order and create a row
                        filteredOrders.forEach(function(order) {
                            console.log(order)
                            let statusColor;
                            switch(order.order.status) {
                                case 'paid':
                                    statusColor = 'text-green-600';  // Green for paid
                                    break;
                                case 'cancelled':
                                    statusColor = 'text-red-600';  // Red for cancelled
                                    break;
                                default:
                                    statusColor = 'text-gray-600';
                            }

                            let row = `
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${order.order.order_id}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${order.order.created_at}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${order.items.map(item => item.name).join(', ')}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm ${statusColor}">${order.order.status}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp ${parseFloat(order.order.total_price).toLocaleString()}</td>
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