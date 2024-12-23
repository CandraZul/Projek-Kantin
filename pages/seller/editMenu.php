<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: ../../login.php");
        exit;
    }else if($_SESSION["user_type"] != "seller"){
        exit;
    }
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/tambahMenu.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Edit Menu</title>
</head>

<body>
    <div class="container">
        <div class="header">Edit Menu</div>
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
                    <input type="file" id="image" name="image" accept="image/*">
                </div>

                <div class="button-group">
                    <a href="aturMenu.php" class="btn btn-cancel">Batal</a>
                    <button type="submit" name="tambah" class="btn btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);
            const foodId = urlParams.get('id');

            $.ajax({
                url: '../../api/foods.php?id=' + foodId,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'sukses') {
                        var food = response.data[0]; 
                        $('#name').val(food.name);
                        $('#description').val(food.description);
                        $('#food_type').val(food.food_type);
                        $('#price').val(food.price);
                        $('#stock').val(food.stock);
                    } else {
                        alert('Gagal mengambil data menu');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil data');
                }
            });

            $('#menuForm').on('submit', function(e) {
                e.preventDefault(); 

                var formData = new FormData(this); 


                formData.append('food_id', foodId); 

                $.ajax({
                    url: `../../api/foods.php?id=${foodId}`, 
                    method: 'POST', 
                    data: formData,
                    processData: false,
                    contentType: false, 
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'sukses') {
                            alert('Data berhasil diperbarui');
                            window.location.href = 'aturMenu.php';
                        } else {
                            alert('Gagal memperbarui data');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); 
                        alert('Terjadi kesalahan saat memperbarui data');
                    }
                });
            });
        });
    </script>
</body>

</html>