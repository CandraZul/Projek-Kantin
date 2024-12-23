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
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            updateFood($id);
        }else{
            insertFood();
        }
        break;
    case 'PUT':
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            updateFood($id);
        }else{
            $respon = [
                'status' => 'gagal',
                'message' => 'Makanan tidak ditemukan, tidak dapat menghapus data'
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

function updateFood($id) {
    global $conn;
    // Mengambil data body PUT request
    header('Content-Type: application/json');

    $name = $_POST['name'];
    $description = $_POST['description'];
    $food_type = $_POST['food_type'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image_url = null;
    
    // Mengolah file gambar jika ada
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_name = $_FILES['image']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = "food_" . time() . "." . $file_ext;
        $upload_dir = "../assets/img/foodMenu/";
        $upload_path = $upload_dir . $new_file_name;
        
        if (move_uploaded_file($file_tmp, $upload_path)) {
            $image_url = $upload_path;
            
            // Mengambil gambar lama dari database
            $query = "SELECT image_url FROM foods WHERE food_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->execute([$id]);
            $old_image = $stmt->fetchColumn();
            
            // Menghapus gambar lama jika ada
            if ($old_image && file_exists($old_image)) {
                unlink($old_image); 
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Gagal mengunggah gambar baru"
            ]);
            return;
        }
    }

    $query = "UPDATE foods SET name = ?, description = ?, food_type = ?, price = ?, stock = ?";
    $params = [$name, $description, $food_type, $price, $stock];

    if ($image_url !== null) {
        $query .= ", image_url = ?";
        $params[] = $image_url;
    }

    $query .= " WHERE food_id = ?";
    $params[] = $id;

    $stmt = $conn->prepare($query);
    $status = $stmt->execute($params);

    if ($status) {
        echo json_encode([
            "status" => "sukses",
            "message" => "Data makanan berhasil diperbarui"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal memperbarui data makanan"
        ]);
    }
}



