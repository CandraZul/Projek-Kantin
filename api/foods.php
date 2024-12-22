<?php
include "../config/connection.php";

$request = $_SERVER["REQUEST_METHOD"];

switch($request) {
    case 'GET':
        if (isset($_GET['action']) && $_GET['action'] === 'favorites') {
            getFavoriteItems();
        }else if(isset($_GET['id'])){
            $id = $_GET['id'];
            getFoods($id);
        }else{
            getFoods();
        }
        break;
    case 'POST':
        break;
    case 'PUT':
        break;
    case 'DELETE':
        break;
}

function getFoods($id=""){
    global $conn;

    $query = "SELECT * FROM foods";
    if(!empty($id)){
        $query .= " WHERE food_id = '$id'";
    }

    $stmt = $conn->prepare($query);
    $stmt->execute();
    
    if ($stmt->rowCount()>0){
        $foods = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode([
            "status" => "sukses",
            "data" => $foods
        ]);
    }else{
        echo json_encode([
            "status" => "error",
            "message" => "Makanan tidak ditemukan"
        ]);
    }
}

function getFavoriteItems() {
    global $conn;

    $query = "
        SELECT 
            f.food_id, 
            f.name AS food_name, 
            f.price, 
            f.image_url, 
            COUNT(oi.food_id) AS total_orders 
        FROM 
            foods f 
        LEFT JOIN 
            order_items oi 
        ON 
            f.food_id = oi.food_id 
        GROUP BY 
            f.food_id 
        ORDER BY 
            total_orders DESC 
        LIMIT 4"; 

    $stmt = $conn->prepare($query);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode([
            "status" => "sukses",
            "data" => $favorites
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Tidak ada makanan favorit"
        ]);
    }
}

