<?php
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : null;
$folder = 'artikel/'; 

if ($id && is_numeric($id)) {
    $filePath = $folder . 'artikel_' . $id . '.txt';

    if (file_exists($filePath)) {
        
        $content = file_get_contents($filePath);

        if ($content === false) {
            echo "Gagal membaca file artikel.";
        } else {
  
            $articleTitle = "Judul Artikel #$id";
            $articleDate = "Tanggal: " . date("d M Y"); 

            
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Detail Artikel</title>
                <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
                <style>
                    body {
                        font-family: 'Arial', sans-serif;
                        background-color: #f8f9fa;
                        background-image: url('../../assets/img/icon/header.jpg'); 
                        background-size: cover; 
                        background-position: center center; 
                        background-attachment: fixed; 
                    }


                    .article-content {
                        background-color: rgba(255, 255, 255, 0.9); /* Latar belakang putih transparan */
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        margin: 20px auto;
                        max-width: 800px;
                    }

                    .article-content h1 {
                        font-size: 28px;
                        color: #333;
                    }

                    .article-content p {
                        font-size: 16px;
                        color: #555;
                        line-height: 1.6;
                    }

                    .article-content blockquote {
                        background-color: #f1f1f1;
                        border-left: 5px solid #5D4037;
                        padding: 10px 15px;
                        font-style: italic;
                        margin: 20px 0;
                        color: #666;
                    }

                    .article-content img {
                        max-width: 100%;
                        height: auto;
                        border-radius: 8px;
                        margin: 20px 0;
                    }

                    .back-button {
                        margin-top: 20px;
                        text-align: center;
                    }

                    .back-button a {
                        text-decoration: none;
                        color: white;
                        background-color:#5D4037;
                        padding: 10px 20px;
                        border-radius: 5px;
                    }
                </style>
            </head>
            <body>
                    <div class='article-content'>
                        <div class='content'>
                            " . nl2br($content) . "
                        </div>
                    </div>
                    <div class='back-button'>
                        <a href='home.php'>Kembali ke Beranda</a>
                    </div>
                </div>
            </body>
            </html>";
        }
    } else {
        echo "Artikel tidak ditemukan.";
    }
} else {
    echo "ID artikel tidak valid.";
}
?>
