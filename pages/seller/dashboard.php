<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
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
                        <a href="dashboard.php" class="flex items-center text-pink-500 p-2 rounded-lg bg-pink-50">
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
</div>


        <!-- Main Content -->
        <div class="flex-1 overflow-auto" style="background-color: #FFF3E9;">
            <!-- Top Navigation -->
            <div class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-8 py-4">
                    <div class="flex items-center flex-1 max-w-md">
                        <div class="relative w-full">
                            <input type="text" placeholder="Search..." 
                                   class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-pink-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Admin Profile -->
                    <div class="flex items-center">
                        <span class="mr-2">Admin</span>
                        <img src="../../assets/img/icon/guest.png" alt="Admin" class="h-8 w-8 rounded-full">
                    </div>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="p-8">
                <!-- Statistics Cards -->
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Grafik Pemasukan</h3>
                        <div class="h-48">
                            <!-- Placeholder for chart -->
                        </div>
                        <div class="mt-4">
                            <span class="text-2xl font-bold">Rp. 229.000</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Grafik Penjualan</h3>
                        <div class="h-48">
                            <!-- Placeholder for chart -->
                        </div>
                        <div class="mt-4">
                            <span class="text-2xl font-bold">Rp. 229.000</span>
                        </div>
                    </div>
                </div>

                <!-- Favorite Items -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4">Favourite Items</h3>
                    <div class="grid grid-cols-4 gap-6">
                        <?php
                        $favorite_items = [
                            [
                                'name' => 'Nasi Goreng',
                                'price' => 'Rp 25.000',
                                'image' => '../../assets/img/foodMenu/nasiGoreng.png'
                            ],
                            [
                                'name' => 'Bakso',
                                'price' => 'Rp 22.000',
                                'image' => '../../assets/img/foodMenu/bakso.jpeg'
                            ],
                            [
                                'name' => 'Sate Ayam',
                                'price' => 'Rp 15.000',
                                'image' => '../../assets/img/foodMenu/sate.jpg'
                            ],
                            [
                                'name' => 'Ayam Penyet',
                                'price' => 'Rp 27.000',
                                'image' => '../../assets/img/foodMenu/ayamPenyet.jpg'
                            ],
                        ];

                        foreach ($favorite_items as $item): ?>
                            <div class="rounded-lg overflow-hidden shadow-sm">
                                <!-- Check image existence -->
                                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h4 class="font-semibold"><?php echo $item['name']; ?></h4>
                                    <div class="flex items-center text-yellow-400 my-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-pink-500 font-semibold">Rp. <?php echo $item['price']; ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/3.7.0/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch all required data when page loads
            fetchDashboardData();
            fetchFavoriteItems();

            // Function to fetch dashboard statistics
            function fetchDashboardData() {
                const statsApiUrl = '../../api/dashboard-stats.php';

                fetch(statsApiUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'sukses') {
                            updateDashboardStats(data.data);
                            createCharts(data.data);
                        } else {
                            console.error('Failed to fetch dashboard stats');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching dashboard stats:', error);
                    });
            }

            // Function to fetch favorite items
            function fetchFavoriteItems() {
                const favoritesApiUrl = '../../api/favorite-foods.php';

                fetch(favoritesApiUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'sukses') {
                            displayFavoriteItems(data.data);
                        } else {
                            console.error('Failed to fetch favorite items');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching favorite items:', error);
                    });
            }

            // Function to update dashboard statistics
            function updateDashboardStats(stats) {
                document.getElementById('totalIncome').textContent = 
                    `Rp. ${stats.total_income.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}`;
                document.getElementById('totalSales').textContent = 
                    `Rp. ${stats.total_sales.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}`;
            }

            // Function to create charts
            function createCharts(stats) {
                // Income Chart
                const incomeCtx = document.getElementById('incomeChart').getContext('2d');
                new Chart(incomeCtx, {
                    type: 'line',
                    data: {
                        labels: stats.income_data.labels,
                        datasets: [{
                            label: 'Pemasukan',
                            data: stats.income_data.values,
                            borderColor: 'rgb(249, 128, 128)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

                // Sales Chart
                const salesCtx = document.getElementById('salesChart').getContext('2d');
                new Chart(salesCtx, {
                    type: 'line',
                    data: {
                        labels: stats.sales_data.labels,
                        datasets: [{
                            label: 'Penjualan',
                            data: stats.sales_data.values,
                            borderColor: 'rgb(134, 239, 172)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }

            // Function to display favorite items
            function displayFavoriteItems(items) {
                const favoriteItemsGrid = document.getElementById('favoriteItemsGrid');
                favoriteItemsGrid.innerHTML = '';

                items.forEach(item => {
                    const itemDiv = document.createElement('div');
                    itemDiv.classList.add('rounded-lg', 'overflow-hidden', 'shadow-sm');

                    const imagePath = item.image_url ? item.image_url.replace(/^"|"$/g, '') : 'default-image.jpg';
                    
                    itemDiv.innerHTML = `
                        <img src="../../${imagePath}" alt="${item.name}" 
                             class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold">${item.name}</h4>
                            <div class="flex items-center text-yellow-400 my-2">
                                ${getRatingStars(item.rating)}
                            </div>
                            <span class="text-pink-500 font-semibold">
                                Rp. ${item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}
                            </span>
                        </div>
                    `;

                    favoriteItemsGrid.appendChild(itemDiv);
                });
            }

            // Helper function to generate rating stars
            function getRatingStars(rating) {
                const fullStars = Math.floor(rating);
                const halfStar = rating % 1 >= 0.5;
                let starsHTML = '';

                for (let i = 0; i < fullStars; i++) {
                    starsHTML += '<i class="fas fa-star"></i>';
                }
                if (halfStar) {
                    starsHTML += '<i class="fas fa-star-half-alt"></i>';
                }
                const emptyStars = 5 - Math.ceil(rating);
                for (let i = 0; i < emptyStars; i++) {
                    starsHTML += '<i class="far fa-star"></i>';
                }

                return starsHTML;
            }

            // Search functionality
            const searchInput = document.querySelector('input[type="text"]');
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const items = document.querySelectorAll('#favoriteItemsGrid > div');
                
                items.forEach(item => {
                    const itemName = item.querySelector('h4').textContent.toLowerCase();
                    if (itemName.includes(searchTerm)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
