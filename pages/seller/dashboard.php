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
                            <span id="totalIncome" class="text-2xl font-bold">Loading...</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Grafik Penjualan</h3>
                        <div class="h-48">
                            <!-- Placeholder for chart -->
                        </div>
                        <div class="mt-4">
                            <span id="totalOrders" class="text-2xl font-bold">Loading...</span>
                        </div>
                    </div>
                </div>

                <!-- Favorite Items -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4">Favourite Items</h3>
                    <div class="grid grid-cols-4 gap-6">
                    <?php
                        $api_url = "http://localhost/Projek-Kantin/api/foods.php?action=favorites";
                        $response = file_get_contents($api_url);
                        $favorites = json_decode($response, true);

                        if ($favorites['status'] === "sukses") {
                            foreach ($favorites['data'] as $item) {
                                echo '
                                <div class="rounded-lg overflow-hidden shadow-sm">
                                    <img src="' . $item['image_url'] . '" alt="' . $item['food_name'] . '" class="w-full h-48 object-cover">
                                    <div class="p-4">
                                        <h4 class="font-semibold text-lg">' . $item['food_name'] . '</h4>
                                        <p class="text-gray-500 text-sm">' . $item['price'] . '</p>
                                    </div>
                                </div>';
                            }
                        } else {
                            echo '<p>' . $favorites['message'] . '</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/3.7.0/chart.min.js"></script>
    <script>
        async function fetchSummary() {
            try {
                const response = await fetch('../../api/order.php?summary=true');
                const data = await response.json();

                if (data.status === 'sukses') {
                    const amount = data.data.total_income;
                    const formattedAmount = new Intl.NumberFormat('id-ID', {
                        style: 'decimal', 
                        minimumFractionDigits: 2, 
                        maximumFractionDigits: 2
                    }).format(amount);
                    document.getElementById('totalIncome').innerText = `Rp. ${formattedAmount}`;
                    document.getElementById('totalOrders').innerText = data.data.total_sold;
                } else {
                    console.error('Gagal mendapatkan data:', data.message);
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
        window.onload = fetchSummary;
    </script>

</body>
</html>
