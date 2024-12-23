<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: ../../login.php");
        exit;
    }else if($_SESSION["user_type"] != "seller"){
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
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
                        <a href="../../api/auth/logout.php" onclick="return confirm('Apakah Anda yakin akan logout?')" class="flex items-center text-gray-600 p-2 rounded-lg hover:bg-gray-50">
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
                    </div>

                    <!-- Admin Profile -->
                    <div class="flex items-center">
                        <span class="mr-2"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
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
                            <div>
                                <canvas id="pemasukan"></canvas>
                            </div>
                        </div>
                        <div class="mt-24">
                            <p class="text-2xl font-bold">Total pemasukan bulan ini: </p>
                            <span id="totalIncome" class="text-2xl font-bold">Loading...</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Grafik Penjualan Item</h3>
                        <div class="h-48">
                            <div>
                                <canvas id="penjualan"></canvas>
                            </div>
                        </div>
                        <div class="mt-24">
                            <p class="text-2xl font-bold">Total penjualan bulan ini: </p>
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
                                    <img src="../' . $item['image_url'] . '" alt="' . $item['food_name'] . '" class="w-full h-48 object-cover">
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

    <script>
        // Fetching data for charts
        fetch('../../api/order.php?summary=true')
            .then(response => response.json())
            .then(data => {
                const months = data.data.months;
                const totalIncome = data.data.total_income;
                const totalSold = data.data.total_sold;

                const formattedAmount = new Intl.NumberFormat('id-ID', {
                    style: 'decimal',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(totalIncome[totalIncome.length - 1]);
                document.getElementById('totalIncome').innerText = `Rp. ${formattedAmount}`;
                document.getElementById('totalOrders').innerText = totalSold[totalSold.length - 1];

                // Creating "Pemasukan" chart
                const ctxPemasukan = document.getElementById('pemasukan').getContext('2d');
                new Chart(ctxPemasukan, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Total Income',
                            data: totalIncome,
                            borderWidth: 2,
                            borderColor: 'rgb(75, 192, 192)',
                            backgroundColor: 'rgba(75, 192, 192, 0.1)',
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Creating "Penjualan" chart
                const ctxPenjualan = document.getElementById('penjualan').getContext('2d');
                new Chart(ctxPenjualan, {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Total Sold',
                            data: totalSold,
                            backgroundColor: 'rgba(153, 102, 255, 0.7)',
                            borderColor: 'rgb(153, 102, 255)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>

</body>

</html>
