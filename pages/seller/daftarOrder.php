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
                        <a href="profile.php" class="flex items-center">
                            <span class="mr-2"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                            <img src="../../assets/img/icon/guest.png" alt="Admin" class="h-8 w-8 rounded-full">
                        </a>
                    </div>
                </div>
            </div>

            <!-- Orders Grid -->
            <div class="grid grid-cols-3 gap-6" id="orders-container">
                <!-- Orders will be dynamically inserted here using AJAX -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '../../api/order.php', 
                type: 'GET',
                data: {
                    all_orders: 'true' 
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'sukses') {
                        var ordersHTML = '';
                        // Loop through each order

                        let filteredOrders = response.data.filter(function(order) {
                            return order.order.status !== 'cancelled' && order.order.status !== 'paid';
                        });

                        $.each(filteredOrders, function (index, orderData) {
                            var order = orderData.order;
                            var items = orderData.items;
                            var orderHTML = `
                                <div class="bg-white rounded-lg p-6 shadow-sm">
                                    <div class="flex justify-between items-center mb-4">
                                        <div class="flex items-center space-x-2">
                                            <div>
                                                <h3 class="font-semibold">Order ${order.order_id}</h3>
                                                <h3 class="font-semibold">Username: ${order.username}</h3>
                                                <h3 class="font-semibold">Telepon: ${order.phone_number}</h3>
                                                <h3 class="font-semibold">Metode Pengiriman: ${order.delivery_option}</h3>
                                                <p class="text-sm text-gray-500">${order.created_at}</p>
                                            </div>
                                        </div>
                                    </div>
                                    `;
                            
                            // Loop through each item in the order
                            $.each(items, function (itemIndex, item) {
                                let imagePath = item.image_url ? item.image_url.replace(/^"|"$/g, '') : 'default-image.jpg';
                                orderHTML += `
                                    <div class="flex items-center space-x-4 mb-4">
                                        <img src="../${imagePath}" alt="${item.name}" class="h-16 w-16 rounded-lg object-cover">
                                        <div class="flex-1">
                                            <h4 class="font-medium">${item.name}</h4>
                                            <p class="text-gray-500">${item.price}</p>
                                        </div>
                                        <div class="text-sm">
                                            Qty: ${item.quantity}
                                        </div>
                                    </div>
                                `;
                            });

                            orderHTML += `
                                <div class="flex justify-between mt-4">
                                    <select class="update-status" data-order-id="${order.order_id}">
                                        <option value="preparing" ${order.status === 'preparing' ? 'selected' : ''}>Preparing</option>
                                        <option value="ready" ${order.status === 'ready' ? 'selected' : ''}>Ready</option>
                                        <option value="delivery" ${order.status === 'delivering' ? 'selected' : ''}>Delivering</option>
                                        <option value="delivered" ${order.status === 'delivered' ? 'selected' : ''}>Delivered</option>
                                        <option value="paid" ${order.status === 'paid' ? 'selected' : ''}>Paid</option>
                                        <option value="cancelled" ${order.status === 'cancelled' ? 'selected' : ''}>Cancelled</option>
                                    </select>
                                </div>
                            `;


                            orderHTML += `</div>`;

                            ordersHTML += orderHTML;

                        });

                        // Insert the generated orders HTML into the container
                        $('#orders-container').html(ordersHTML);

                        $('#orders-container').on('change', '.update-status', function () {
                            var orderId = $(this).data('order-id'); 
                            var newStatus = $(this).val(); 

                            updateOrderStatus(orderId, newStatus);
                        });


                        $('#orders-container').css({
                            'padding': '24px',
                            'border-radius': '8px'
                        });
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert("An error occurred while fetching the data.");
                }
            });
        });

        function updateOrderStatus(orderId, newStatus) {
            console.log('Updating Order:', { orderId, newStatus }); // Log the data
            $.ajax({
                url: `../../api/order.php?id=${orderId}`, // Endpoint API
                type: 'PUT', // Metode HTTP
                contentType: 'application/json', // Format data
                data: JSON.stringify({ status: newStatus }), // Data yang dikirim
                success: function (response) {
                    try {
                        var res = JSON.parse(response);
                        if (res.status === 'sukses') {
                            alert('Pesanan berhasil diperbarui!');
                        } else {
                            alert('Gagal memperbarui pesanan: ' + res.message);
                        }
                    } catch (e) {
                        alert('Terjadi kesalahan pada respon server.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghubungi server.');
                }
            });
        }

    </script>
</body>

</html>
