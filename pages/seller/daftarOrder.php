<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Order - Kantin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
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
                            <a href="daftarOrder.php" class="flex items-center text-pink-500 p-2 rounded-lg bg-pink-50">
                                <i class="fas fa-clipboard-list mr-3"></i>
                                <span>Daftar Order</span>
                            </a>
                        </li>
                        <li>
                            <a href="riwayatOrder.php" class="flex items-center text-gray-600 p-2 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-history mr-3"></i>
                                <span>Riwayat Order</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                
                <!-- Logout Button -->
                <div class="absolute bottom-4 w-56">
            <a href="../../login.php" class="flex items-center text-gray-600 p-2 rounded-lg hover:bg-gray-50">
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
                    <h2 class="text-xl font-semibold">Daftar Order</h2>
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

            <!-- Order Filter -->
            <div class="p-8">
                <div class="flex gap-4 mb-6">
                    <button class="px-4 py-2 rounded-full text-gray-600 bg-white hover:bg-gray-50">#1234</button>
                    <button class="px-4 py-2 rounded-full text-gray-600 bg-white hover:bg-gray-50">#5789</button>
                    <button class="px-4 py-2 rounded-full text-gray-600 bg-white hover:bg-gray-50">#4543</button>
                    <button class="px-4 py-2 rounded-full text-gray-600 bg-white hover:bg-gray-50">#3456</button>
                    <button class="px-4 py-2 rounded-full text-gray-600 bg-white hover:bg-gray-50">#6789</button>
                    <button class="px-4 py-2 rounded-full text-gray-600 bg-white hover:bg-gray-50">#8901</button>
                    <button class="px-4 py-2 rounded-full text-gray-600 bg-white hover:bg-gray-50">#3322</button>
                    <button class="px-4 py-2 rounded-full text-gray-600 bg-white hover:bg-gray-50">#4433</button>
                    <button class="px-4 py-2 rounded-full text-gray-600 bg-white hover:bg-gray-50">#5544</button>
                </div>

                <!-- Orders Grid -->
                <div class="grid grid-cols-3 gap-6">
                    <?php
                    $orders = [
                        [
                            'id' => '#5521',
                            'time' => '10:25 PM',
                            'items' => [
                                ['name' => 'Soto', 'price' => '65000', 'qty' => 4],
                                ['name' => 'Bakso', 'price' => '35000', 'qty' => 2]
                            ],
                            'status' => 'pending',
                            'user_avatar' => '1.jpg'
                        ],
                        [
                            'id' => '#6650',
                            'time' => '10:54 PM',
                            'items' => [
                                ['name' => 'Gado-gado', 'price' => '30000', 'qty' => 1],
                                ['name' => 'Nasi Kuning', 'price' => '20000', 'qty' => 1]
                            ],
                            'status' => 'pending',
                            'user_avatar' => '2.jpg'
                        ],
                        [
                            'id' => '#5545',
                            'time' => '11:15 PM',
                            'items' => [
                                ['name' => 'Soto', 'price' => '20000', 'qty' => 1],
                                ['name' => 'Mie Ayam', 'price' => '20000', 'qty' => 1]
                            ],
                            'status' => 'confirmed',
                            'user_avatar' => '3.jpg'
                        ],
                    ];

                    foreach ($orders as $order): ?>
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center space-x-2">
                                <img src="avatars/<?php echo $order['user_avatar']; ?>" alt="User" class="h-8 w-8 rounded-full">
                                <div>
                                    <h3 class="font-semibold">Order <?php echo $order['id']; ?></h3>
                                    <p class="text-sm text-gray-500"><?php echo $order['time']; ?></p>
                                </div>
                            </div>
                        </div>

                        <?php foreach ($order['items'] as $item): ?>
                        <div class="flex items-center space-x-4 mb-4">
                            <img src="menu-images/food-placeholder.jpg" alt="<?php echo $item['name']; ?>" class="h-16 w-16 rounded-lg object-cover">
                            <div class="flex-1">
                                <h4 class="font-medium"><?php echo $item['name']; ?></h4>
                                <p class="text-gray-500"><?php echo $item['price']; ?></p>
                            </div>
                            <div class="text-sm">
                                Qty: <?php echo $item['qty']; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <div class="flex justify-between mt-4">
                            <?php if ($order['status'] === 'pending'): ?>
                            <button class="text-pink-500 hover:underline">Cancel</button>
                            <button class="text-green-500 hover:underline">Confirm</button>
                            <?php else: ?>
                            <button class="text-green-500">Confirmed</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>