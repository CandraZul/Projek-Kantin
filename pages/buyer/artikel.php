<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;

$folder = 'artikel/';

if ($id && is_numeric($id)) {
    $filePath = $folder . 'artikel_' . $id . '.txt';

    if (file_exists($filePath)) {
        $content = file_get_contents($filePath);

        if ($content === false) {
            echo "Gagal membaca file artikel.";
        } else {
            echo nl2br($content); 
        }
    } else {
        echo "Artikel tidak ditemukan.";
    }
} else {
    echo "ID artikel tidak valid.";
}
?>
