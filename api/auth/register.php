<?php
header("Content-Type: application/json");
session_start();
include "../../config/connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $data = json_decode(file_get_contents("php://input"), true);

    $username = $data["username"];
    $email = $data["email"];
    $password = $data["password"];
    $phone_number = $data["phone_number"];

    $query = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($query);
    $stmt->execute(array($email));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user){
        echo json_encode(["status" => "error", "message" => "Email sudah digunakan"]);
    }else{
        $query = "INSERT INTO users (username, email, password, phone_number, user_type) VALUES (?, ?, ?, ?, 'buyer')";
        $stmt = $conn->prepare($query);
        $status = $stmt->execute(array($username, $email, $password, $phone_number));

        if ($status){
            echo json_encode(["status" => "success", "message" => "Registrasi berhasil"]);
        }else{
            echo json_encode(["status" => "error", "message" => "Gagal menyimpan data"]);
        }

    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode request tidak valid"]);
}