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
        insertFood();
        break;
    case 'PUT':
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            updateFood($id);
        }else{
            $respon = [
                'status' => 'gagal',
                'message' => 'Makanan tidak ditemukan, tidak dapat mengupdate data'
            ];
            header('Content-Type: application/json');
            echo json_encode($respon);
        }
        break;
    case 'DELETE':
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            deleteFood($id);
        }else{
            $respon = [
                'status' => 'gagal',
                'message' => 'Makanan tidak ditemukan, tidak dapat menghapus data'
            ];
            header('Content-Type: application/json');
            echo json_encode($respon);
        }
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

function insertFood(){
    global $conn;

    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data['name'];
    $description = $data['description'];
    $food_type = $data['food_type'];
    $price = $data['price'];
    $stock = $data['stock'];
    $image_url = $data['image_url'];

    $query = "INSERT INTO foods SET name=?, description=?, food_type=?, price=?, stock=?, image_url=?";
    $stmt= $conn->prepare($query);
    $status = $stmt->execute(array($name, $description, $food_type, $price, $stock, $image_url));

    if($status){
        echo json_encode([
            "status" => "sukses",
            "message" => "Makanan berhasil ditambahkan"
        ]);
    }else{
        echo json_encode([
            "status" => "error",
            "message" => "Data yang diberikan tidak lengkap"
        ]);
    }
}

function updateFood($id){
    global $conn;

    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data['name'];
    $description = $data['description'];
    $food_type = $data['food_type'];
    $price = $data['price'];
    $stock = $data['stock'];
    $image_url = $data['image_url'];

    $query = "UPDATE foods SET name=?, description=?, food_type=?, price=?, stock=?, image_url=? WHERE food_id=?";
    $stmt= $conn->prepare($query);
    $status = $stmt->execute(array($name, $description, $food_type, $price, $stock, $image_url, $id));

    if($status){
        echo json_encode([
            "status" => "sukses",
            "message" => "Makanan berhasil diperbarui"
        ]);
    }else{
        echo json_encode([
            "status" => "error",
            "message" => "Data yang diberikan tidak lengkap"
        ]);
    }
}

function deleteFood($id){
    global $conn;
    $query = "DELETE FROM foods WHERE food_id=?";
    $stmt = $conn->prepare($query);
    $status = $stmt->execute(array($id));

    if($status){
        echo json_encode([
            "status" => "sukses",
            "message" => "Makanan berhasil dihapus"
        ]);
    }else{
        echo json_encode([
            "status" => "error",
            "message" => "Makanan tidak berhasil dihapus"
        ]);
    }
}


