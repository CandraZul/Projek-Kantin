<?php
if(isset($_POST['tambah'])) {
    header("Location: aturMenu.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/tambahMenu.css">
    <title>Tambah Menu</title>
    
</head>
<body>
    <div class="container">
        <div class="header">Tambah Menu</div>
        <div class="form-content">
        <form id="menuForm" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nama Menu :</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi :</label>
                    <textarea id="description" name="description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="food_type">Tipe Menu :</label>
                    <select id="food_type" name="food_type" required>
                        <option value="">Pilih Tipe Menu</option>
                        <option value="Breakfast">Breakfast</option>
                        <option value="Main Dishes">Main Dishes</option>
                        <option value="Drinks">Drinks</option>
                        <option value="Desserts">Desserts</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Harga :</label>
                    <input type="text" id="price" name="price" required>
                </div>

                <div class="form-group">
                    <label for="stock">Stok :</label>
                    <input type="number" id="stock" name="stock" required>
                </div>

                <div class="form-group">
                    <label for="image">Gambar Menu :</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>

                <div class="button-group">
                    <a href="aturMenu.php" class="btn btn-cancel">Batal</a>
                    <button type="submit" name="tambah" class="btn btn-submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById("menuForm").addEventListener("submit", function(event) {
            event.preventDefault(); 

            var formData = new FormData(this); 

            fetch("../../api/foods.php", {  
                method: "POST",
                body: formData
            })
            .then(response => response.text()) 
            .then(data => {
                console.log(data); 
                try {
                    const jsonData = JSON.parse(data);  
                    if(jsonData.status === "sukses") {
                        alert("Menu berhasil ditambahkan!");
                        window.location.href = "aturMenu.php"; 
                    } else {
                        alert("Terjadi kesalahan: " + jsonData.message);
                    }
                } catch (error) {
                    alert("Error parsing JSON: " + error.message);
                }
            })
            .catch(error => {
                alert("Terjadi kesalahan: " + error.message);
            });
        });
    </script>
</body>
</html>