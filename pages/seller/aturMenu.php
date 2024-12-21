<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Menu - Kantin</title>
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
                        <img src="logo.png" alt="Kantin Logo" class="h-8 mr-2">
                        <h1 class="text-xl font-bold">Kantin</h1>
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
                            <a href="aturMenu.php" class="flex items-center text-pink-500 p-2 rounded-lg bg-pink-50">
                                <i class="fas fa-utensils mr-3"></i>
                                <span>Atur Menu</span>
                            </a>
                            <!-- Submenu -->
                            <ul class="ml-8 mt-2 space-y-2">
                                <li>
                                    <a href="tambahMenu.php" class="text-gray-600 hover:text-pink-500">Tambah Menu</a>
                                </li>
                                <li>
                                    <a href="editMenu.php" class="text-gray-600 hover:text-pink-500">Edit Menu</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="daftarOrder.php" class="flex items-center text-gray-600 p-2 rounded-lg hover:bg-gray-50">
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
                    <a href="logout.php" class="flex items-center text-gray-600 p-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Navigation -->
            <div class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-8 py-4">
                    <h2 class="text-xl font-semibold">Atur Menu</h2>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Search..." 
                                   class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-pink-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <a href="tambahMenu.php" class="bg-orange-400 text-white px-4 py-2 rounded-lg hover:bg-orange-500">
                            Tambah Menu
                        </a>
                        <a href="profile.php" class="flex items-center">
                            <span class="mr-2">Admin</span>
                            <img src="admin-avatar.png" alt="Admin" class="h-8 w-8 rounded-full">
                        </a>
                    </div>
                </div>
            </div>

            <!-- Menu Grid -->
            <div class="p-8">
                <div class="grid grid-cols-4 gap-6">
                    <?php
                    $menu_items = [
                        [
                            'name' => 'Mie Ayam',
                            'category' => 'FoodRecipe',
                            'price' => '45000',
                            'image' => 'assets/img/foodMenu/mie_ayam.jpg'
                        ],
                        [
                            'name' => 'Bakso',
                            'category' => 'FoodRecipe',
                            'price' => '65000',
                            'image' => 'images/menu/bakso.jpg'
                        ],
                        [
                            'name' => 'Soto',
                            'category' => 'FoodRecipe',
                            'price' => '35000',
                            'image' => 'images/menu/soto.jpg'
                        ],
                        [
                            'name' => 'Nasi Kuning',
                            'category' => 'FoodRecipe',
                            'price' => '30000',
                            'image' => 'images/menu/nasi-kuning.jpg'
                        ],
                        [
                            'name' => 'Nasi Liwet',
                            'category' => 'FoodRecipe',
                            'price' => '40000',
                            'image' => 'images/menu/nasi-liwet.jpg'
                        ],
                        [
                            'name' => 'Sop',
                            'category' => 'FoodRecipe',
                            'price' => '42000',
                            'image' => 'images/menu/sop.jpg'
                        ],
                        [
                            'name' => 'Kari',
                            'category' => 'FoodRecipe',
                            'price' => '38000',
                            'image' => 'images/menu/kari.jpg'
                        ],
                        [
                            'name' => 'Gado-gado',
                            'category' => 'FoodRecipe',
                            'price' => '35000',
                            'image' => 'images/menu/gado-gado.jpg'
                        ],
                    ];

                    foreach ($menu_items as $item): ?>
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="relative">
                                <img src="food-placeholder.jpg" alt="<?php echo $item['name']; ?>" 
                                     class="w-full h-48 object-cover">
                                <div class="absolute bottom-2 left-2">
                                    <span class="bg-white text-sm px-2 py-1 rounded">
                                        <?php echo $item['category']; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold mb-2"><?php echo $item['name']; ?></h3>
                                <p class="text-gray-600 text-sm mb-2">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                                <div class="flex justify-between text-sm">
                                    <a href="viewMenu.php?id=<?php echo urlencode($item['name']); ?>" 
                                       class="text-blue-500 hover:underline">View</a>
                                    <a href="editMenu.php?id=<?php echo urlencode($item['name']); ?>" 
                                       class="text-green-500 hover:underline">Edit</a>
                                    <a href="duplicateMenu.php?id=<?php echo urlencode($item['name']); ?>" 
                                       class="text-gray-500 hover:underline">Duplicate</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>