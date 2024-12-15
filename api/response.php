<?php
function json_response($status_code, $data = []){
    http_response_code($status_code);
    header('Content-Type: application/json');

    $response = [
        'status_code' => $status_code,
        'message' => isset($data['message']) ? $data['message'] : '',
        'data' => isset($data['data']) ? $data['data'] : null
    ];

    echo json_encode($response);
    exit;
}