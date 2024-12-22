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
        } else {
            getOrders();
        }
        break;
    case 'POST':
        createOrder();
        break;
    case 'PUT':
        parse_str(file_get_contents("php://input"), $_PUT);
        if (isset($_PUT['id'])) {
            $id = $_PUT['id'];
            updateOrder($id, $_PUT);
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

    $data = json_decode(file_get_contents("php://input"), true);
    $buyer_id = $data['buyer_id'];
    $food_id = $data['food_id'];
    $quantity = $data['quantity'];
    $total_price = $data['total_price'];
    $delivery_option = $data['delivery_option'];

    try {
        $queryOrder = "INSERT INTO orders (buyer_id, delivery_option, status, total_price, created_at) VALUES (:buyer_id, :delivery_option, 'preparing', :total_price, NOW())";
        $stmtOrder = $conn->prepare($queryOrder);
        $stmtOrder->bindParam(':buyer_id', $buyer_id);
        $stmtOrder->bindParam(':delivery_option', $delivery_option);
        $stmtOrder->bindParam(':total_price', $total_price);
        $stmtOrder->execute();

        $order_id = $conn->lastInsertId(); 

        $queryItems = "INSERT INTO order_items (order_id, food_id, quantity) VALUES (:order_id, :food_id, :quantity)";
        $stmtItems = $conn->prepare($queryItems);
        $stmtItems->bindParam(':order_id', $order_id);
        $stmtItems->bindParam(':food_id', $food_id);
        $stmtItems->bindParam(':quantity', $quantity);
        $stmtItems->execute();

        echo json_encode([
            "status" => "sukses",
            "message" => "Pesanan berhasil dibuat",
            "order_id" => $order_id
        ]);
    } catch (PDOException $e) {
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

    try {
        // Total pemasukan
        $queryIncome = "SELECT SUM(total_price) AS total_income FROM orders WHERE status='paid'";
        $stmtIncome = $conn->prepare($queryIncome);
        $stmtIncome->execute();
        $resultIncome = $stmtIncome->fetch(PDO::FETCH_ASSOC);
        $total_income = $resultIncome['total_income'] ?? 0;

        // Total pesanan
        $queryOrders = "SELECT SUM(quantity) AS total_sold FROM order_items";
        $stmtOrders = $conn->prepare($queryOrders);
        $stmtOrders->execute();
        $resultOrders = $stmtOrders->fetch(PDO::FETCH_ASSOC);
        $total_orders = $resultOrders['total_sold'] ?? 0;

        echo json_encode([
            "status" => "sukses",
            "data" => [
                "total_income" => $total_income,
                "total_sold" => $total_orders
            ]
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal mendapatkan data: " . $e->getMessage()
        ]);
    }
}


?>
