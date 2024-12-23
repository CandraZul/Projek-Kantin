<?php 
include "../config/connection.php";

$request = $_SERVER["REQUEST_METHOD"];

switch($request) {
    case 'GET':
        if (isset($_GET['summary']) && $_GET['summary'] === 'true') {
            getTotalIncomeAndOrders();
        } elseif (isset($_GET['id'])) {
            $id = $_GET['id'];
            getOrder($id);
        } elseif (isset($_GET['all_orders']) && $_GET['all_orders'] === 'true') {
            getAllOrdersWithItems();
        } else {
            getOrders();
        }
        break;
    case 'POST':
        createOrder();
        break;
    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            updateOrder($id, $data);
        }
        break;
    case 'DELETE':
        parse_str(file_get_contents("php://input"), $_DELETE);
        if (isset($_DELETE['id'])) {
            $id = $_DELETE['id'];
            deleteOrder($id);
        }
        break;
}

// Fungsi untuk mendapatkan semua pesanan
function getOrders() {
    global $conn;

    $query = "SELECT * FROM orders";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode([
            "status" => "sukses",
            "data" => $orders
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Pesanan tidak ditemukan"
        ]);
    }
}

// Fungsi untuk mendapatkan detail pesanan berdasarkan ID
function getOrder($id) {
    global $conn;

    $query = "SELECT * FROM orders WHERE order_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode([
            "status" => "sukses",
            "data" => $order
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Pesanan tidak ditemukan"
        ]);
    }
}

// Fungsi untuk membuat pesanan baru
function createOrder() {
    global $conn;

    // Membaca JSON yang dikirimkan dan mendekode ke dalam array
    $data = json_decode(file_get_contents("php://input"), true);

    // Ambil data utama pesanan
    $buyer_id = $data['buyer_id'];
    $total_price = $data['total_price'];
    $delivery_option = $data['delivery_option'];

    try {
        // Query untuk memasukkan pesanan baru ke dalam tabel 'orders'
        $queryOrder = "INSERT INTO orders (buyer_id, delivery_option, status, total_price, created_at) VALUES (:buyer_id, :delivery_option, 'preparing', :total_price, NOW())";
        $stmtOrder = $conn->prepare($queryOrder);
        $stmtOrder->bindParam(':buyer_id', $buyer_id);
        $stmtOrder->bindParam(':delivery_option', $delivery_option);
        $stmtOrder->bindParam(':total_price', $total_price);
        $stmtOrder->execute();

        // Mendapatkan ID pesanan yang baru dibuat
        $order_id = $conn->lastInsertId();

        // Memasukkan data item pesanan ke dalam tabel 'order_items'
        $queryItems = "INSERT INTO order_items (order_id, food_id, quantity, total) VALUES (:order_id, :food_id, :quantity, :total)";
        $stmtItems = $conn->prepare($queryItems);

        // Proses setiap item dari array 'items'
        foreach ($data['items'] as $item) {
            $food_id = $item['food_id'];
            $quantity = $item['quantity'];
            $total = $item['total'];

            $stmtItems->bindParam(':order_id', $order_id);
            $stmtItems->bindParam(':food_id', $food_id);
            $stmtItems->bindParam(':quantity', $quantity);
            $stmtItems->bindParam(':total', $total);
            $stmtItems->execute();
        }

        // Mengirimkan response sukses
        echo json_encode([
            "status" => "sukses",
            "message" => "Pesanan berhasil dibuat",
            "order_id" => $order_id
        ]);
    } catch (PDOException $e) {
        // Menangani error dan mengirimkan response error
        echo json_encode([
            "status" => "error",
            "message" => "Gagal membuat pesanan: " . $e->getMessage()
        ]);
    }
}



// Memperbarui pesanan
function updateOrder($id, $data) {
    global $conn;

    $status = $data['status'];

    $query = "UPDATE orders SET status = :status WHERE order_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "sukses",
            "message" => "Pesanan berhasil diperbarui"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal memperbarui pesanan"
        ]);
    }
}

// Menghapus pesanan
function deleteOrder($id) {
    global $conn;

    $query = "DELETE FROM orders WHERE order_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "sukses",
            "message" => "Pesanan berhasil dihapus"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal menghapus pesanan"
        ]);
    }
}

// Fungsi untuk mendapatkan total pemasukan dan total pesanan
function getTotalIncomeAndOrders() {
    global $conn;

    $monthsBack = 6;  // Menentukan jumlah bulan yang ingin ditampilkan (misalnya 6 bulan terakhir)
    $currentDate = date('Y-m');  // Tanggal bulan ini (contoh: 2024-12)

    // Array untuk menampung hasil pendapatan dan pesanan
    $total_income_data = [];
    $total_orders_data = [];
    $months = [];

    try {
        // Query untuk mengambil pemasukan dan jumlah pesanan selama beberapa bulan terakhir
        for ($i = $monthsBack - 1; $i >= 0; $i--) {
            // Menghitung tanggal bulan yang diinginkan
            $targetMonth = date('Y-m', strtotime("-$i month", strtotime($currentDate)));

            // Menyimpan nama bulan
            $months[] = $targetMonth;

            // Mengambil total pemasukan per bulan
            $queryIncome = "SELECT SUM(total_price) AS total_income 
                            FROM orders 
                            WHERE status='paid' 
                            AND DATE_FORMAT(created_at, '%Y-%m') = :targetMonth";
            $stmtIncome = $conn->prepare($queryIncome);
            $stmtIncome->bindParam(':targetMonth', $targetMonth);
            $stmtIncome->execute();
            $resultIncome = $stmtIncome->fetch(PDO::FETCH_ASSOC);
            $total_income_data[] = $resultIncome['total_income'] ?? 0;

            // Mengambil total pesanan per bulan
            $queryOrders = "SELECT SUM(quantity) AS total_sold 
                            FROM order_items 
                            JOIN orders ON orders.order_id = order_items.order_id
                            WHERE DATE_FORMAT(orders.created_at, '%Y-%m') = :targetMonth";
            $stmtOrders = $conn->prepare($queryOrders);
            $stmtOrders->bindParam(':targetMonth', $targetMonth);
            $stmtOrders->execute();
            $resultOrders = $stmtOrders->fetch(PDO::FETCH_ASSOC);
            $total_orders_data[] = $resultOrders['total_sold'] ?? 0;
        }

        // Mengirimkan data dalam format JSON
        echo json_encode([
            "status" => "sukses",
            "data" => [
                "months" => $months,
                "total_income" => $total_income_data,
                "total_sold" => $total_orders_data
            ]
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal mendapatkan data: " . $e->getMessage()
        ]);
    }
}

function getAllOrdersWithItems() {
    global $conn;

    // Query untuk mendapatkan semua pesanan
    $query = "
        SELECT * 
        FROM 
            orders
        JOIN 
            users 
        ON 
            users.user_id = orders.buyer_id
        ORDER BY 
            orders.created_at ASC;";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $response = [];

        foreach ($orders as $order) {
            // Query untuk mendapatkan item berdasarkan order_id
            $query_items = "
                SELECT 
                    order_items.order_id, 
                    order_items.quantity, 
                    order_items.food_id, 
                    foods.name, 
                    foods.image_url, 
                    foods.price
                FROM 
                    order_items
                JOIN 
                    foods 
                ON 
                    foods.food_id = order_items.food_id
                WHERE 
                    order_items.order_id = :order_id
                ORDER BY 
                    order_items.order_id DESC;
            ";
            $stmt_items = $conn->prepare($query_items);
            $stmt_items->bindParam(':order_id', $order['order_id']);
            $stmt_items->execute();
            $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

            // Menambahkan order dan item dalam response
            $response[] = [
                'order' => $order,
                'items' => $items
            ];
        }

        echo json_encode([
            "status" => "sukses",
            "data" => $response
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Pesanan tidak ditemukan"
        ]);
    }
}

?>
