<?php
header("Content-Type: application/json");
session_start();
include "../../config/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $email = $data["email"];
    $password = $data["password"];
    
    $query = $conn->prepare("SELECT * FROM users WHERE email=?");
    $query->execute(array($email));
    
    $control = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($control) {
        if ($password == $control["password"]) {
            $_SESSION["username"] = $control["username"];
            $_SESSION["user_type"] = $control["user_type"];
            echo json_encode(["status" => "success", "message" => "Login berhasil", "user_type" => $control["user_type"]]);
        } else {
            echo json_encode(["status" => "error", "message" => "Email dan Password tidak sesuai"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Email tidak ditemukan"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>
