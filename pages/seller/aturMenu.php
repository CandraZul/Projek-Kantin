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
                            <img src="../../assets/img/icon/guest.png" alt="Admin" class="h-8 w-8 rounded-full">
                        </a>
                    </div>
                </div>
            </div>

            <!-- Menu Grid -->
            <div class="p-8">
                <div class="flex justify-end mb-4">
                    <a href="tambahMenu.php" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">
                        + Tambah Menu
                    </a>
                </div>
                <div id="menuGrid" class="grid grid-cols-4 gap-6">

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchMenuItems();

            function fetchMenuItems() {
                const apiUrl = '../../api/foods.php';

                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'sukses') {
                            displayMenuItems(data.data);
                        } else {
                            alert('Menu tidak ditemukan');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching menu:', error);
                    });
            }

            function displayMenuItems(items) {
                const menuGrid = document.getElementById('menuGrid');
                menuGrid.innerHTML = '';

                items.forEach(item => {
                    const itemDiv = document.createElement('div');
                    itemDiv.classList.add('bg-white', 'rounded-lg', 'shadow-sm', 'overflow-hidden');

                    const imageDiv = document.createElement('div');
                    imageDiv.classList.add('relative');
                    const image = document.createElement('img');
                    let imagePath = item.image_url ? item.image_url.replace(/^"|"$/g, '') : 'default-image.jpg';
                    image.src = `../${imagePath}`;
                    console.log(imagePath); 
                    image.alt = item.name;
                    image.classList.add('w-full', 'h-48', 'object-cover');
                    imageDiv.appendChild(image);

                    const labelDiv = document.createElement('div');
                    labelDiv.classList.add('absolute', 'bottom-2', 'left-2');
                    const label = document.createElement('span');
                    label.classList.add('bg-white', 'text-sm', 'px-2', 'py-1', 'rounded');
                    label.textContent = item.category;
                    labelDiv.appendChild(label);

                    const detailsDiv = document.createElement('div');
                    detailsDiv.classList.add('p-4');
                    const title = document.createElement('h3');
                    title.classList.add('font-semibold', 'mb-2');
                    title.textContent = item.name;
                    const price = document.createElement('p');
                    price.classList.add('text-gray-600', 'text-sm', 'mb-2');
                    price.textContent = `Rp ${item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}`;

                    const actionDiv = document.createElement('div');
                    actionDiv.classList.add('flex', 'justify-between', 'text-sm');

                    const viewLink = document.createElement('a');
                    viewLink.href = `viewMenu.php?id=${item.food_id}`;
                    viewLink.classList.add('text-blue-500', 'hover:underline');
                    viewLink.textContent = 'View';

                    const editLink = document.createElement('a');
                    editLink.href = `editMenu.php?id=${item.food_id}`;
                    editLink.classList.add('text-green-500', 'hover:underline');
                    editLink.textContent = 'Edit';

                    const deleteLink = document.createElement('a');
                    deleteLink.href = `deleteMenu.php?id=${item.food_id}`;
                    deleteLink.classList.add('text-gray-500', 'hover:underline');
                    deleteLink.textContent = 'Delete';

                    actionDiv.appendChild(viewLink);
                    actionDiv.appendChild(editLink);
                    actionDiv.appendChild(deleteLink);

                    detailsDiv.appendChild(title);
                    detailsDiv.appendChild(price);
                    detailsDiv.appendChild(actionDiv);

                    itemDiv.appendChild(imageDiv);
                    itemDiv.appendChild(detailsDiv);

                    menuGrid.appendChild(itemDiv);
                });
            }
        });
    </script>
</body>

</html>