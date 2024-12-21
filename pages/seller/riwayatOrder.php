<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Order - Kantin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-4">
                <div class="flex items-center mb-8">
                    <a href="dashboard.php" class="flex items-center">
                        <img src="../../assets/img/icon/logo.png" alt="Kantin Logo" class="h-14 mr-2">
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
                    <a href="login.php" class="flex items-center text-gray-600 p-2 rounded-lg hover:bg-gray-50">
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
                        <div class="relative">
                            <input type="text" placeholder="Search..." 
                                   class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-pink-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <a href="profile.php" class="flex items-center">
                            <span class="mr-2">Admin</span>
                            <img src="../../assets/img/icon/guest.png" alt="Admin" class="h-8 w-8 rounded-full">
                        </a>
                    </div>
                </div>
            </div>

            <!-- Order History Table -->
            <div class="p-8">
                <div class="bg-white rounded-lg shadow">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu Item</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Food Item</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            $orders = [
                                ['id' => '#12345', 'date' => 'Jan 20, 2023', 'menu' => 'Soto', 'qty' => '2', 'status' => 'Sukses', 'total' => '50000'],
                                ['id' => '#12346', 'date' => 'Feb 15, 2023', 'menu' => 'Bakso', 'qty' => '1', 'status' => 'Sukses', 'total' => '50000'],
                                ['id' => '#12347', 'date' => 'Feb 15, 2023', 'menu' => 'Soto', 'qty' => '3', 'status' => 'Sukses', 'total' => '45000'],
                                ['id' => '#12348', 'date' => 'Feb 26, 2023', 'menu' => 'Mie Ayam', 'qty' => '1', 'status' => 'Sukses', 'total' => '35000'],
                                ['id' => '#12349', 'date' => 'March 18, 2023', 'menu' => 'Nasi Kuning', 'qty' => '1', 'status' => 'Sukses', 'total' => '35000'],
                                ['id' => '#12350', 'date' => 'March 18, 2023', 'menu' => 'Kari', 'qty' => '1', 'status' => 'Sukses', 'total' => '50000'],
                            ];

                            foreach ($orders as $order):
                                $statusColor = match($order['status']) {
                                    'Sukses' => 'text-green-600',
                                    'In Process' => 'text-yellow-600',
                                    'Ready Pick Up' => 'text-blue-600',
                                    'Ready Sending' => 'text-purple-600',
                                    'Missing' => 'text-red-600',
                                    'Done' => 'text-green-600',
                                    default => 'text-gray-600'
                                };
                            ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $order['id']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $order['date']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $order['qty']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $order['menu']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm <?php echo $statusColor; ?>"><?php echo $order['status']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp <?php echo $order['total']; ?></td>
                            </tr>
                            <?php endforeach; ?>
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
</body>
</html>