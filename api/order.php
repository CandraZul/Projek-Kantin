<?php
include '../config/connection.php';

$request = $_SERVER['REQUEST_METHOD'];

switch ($request) {
    case 'GET':
        if (!isset($_GET['id'])) {
            $id = $_GET['id'];
            getOrder($id);
        }else {
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

function getOrder($id) {
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

function createOrder() {
    global $conn;

    $data = json_decode(file_get_contents("php://input"), true);
    $user_id = $data['user_id'];
    $food_id = $data['food_id'];
    $quantity = $data['quantity'];
    $delivery_option = $data['delivery_option'];

    try {

        $queryOrder = "INSERT INTO orders (user_id, delivery_option, status, order_code) VALUES (:user_id, :delivery_option, 'pending', :order_code)";
        $stmtOrder = $conn->prepare($queryOrder);
        $stmtOrder->bindParam(':user_id', $user_id);
        $stmtOrder->bindParam(':delivery_option', $delivery_option);
        $stmtOrder->execute();

        $order_id = $conn->lastInsertId(); // Dapatkan ID pesanan baru

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
?>