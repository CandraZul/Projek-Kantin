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
        insertFood();
        break;
    case 'PUT':
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

function insertFood() {
    global $conn;
    header('Content-Type: application/json');

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_name = $_FILES['image']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = "food_" . time() . "." . $file_ext;
        $upload_dir = "../assets/img/foodMenu/";
        $upload_path = $upload_dir . $new_file_name;

 
        if (move_uploaded_file($file_tmp, $upload_path)) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $food_type = $_POST['food_type'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];

            $query = "INSERT INTO foods (name, description, food_type, price, stock, image_url) 
                      VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $status = $stmt->execute([$name, $description, $food_type, $price, $stock, $upload_path]);

            if ($status) {
                echo json_encode([
                    "status" => "sukses",
                    "message" => "Makanan berhasil ditambahkan"
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Gagal menyimpan data ke database"
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Gagal mengunggah gambar"
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Gambar tidak valid atau tidak ada"
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