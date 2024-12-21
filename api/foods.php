<?php
include "../config/connection.php";

$request = $_SERVER["REQUEST_METHOD"];

switch($request) {
    case 'GET':
        if(isset($_GET['id'])){
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
