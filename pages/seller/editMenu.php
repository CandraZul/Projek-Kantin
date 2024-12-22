<?php
if(isset($_POST['edit'])) {
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
                        <option value="Makanan">Makanan</option>
                        <option value="Minuman">Minuman</option>
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
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const id = urlParams.get('id'); 
            const form = document.getElementById('menuForm');
            const apiUrl = `../../api/foods.php?id=${id}`;

            function fetchMenuItem() {
                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'sukses') {
                            const result = data.data[0];
                            populateForm(result);
                        } else {
                            alert('Menu tidak ditemukan');
                        }
                    })
                    .catch(error => console.error('Error fetching menu:', error));
            }

            function populateForm(data) {
                document.getElementById('name').value = data.name;
                document.getElementById('description').value = data.description;
                document.getElementById('food_type').value = data.food_type;
                document.getElementById('price').value = data.price;
                document.getElementById('stock').value = data.stock;
            }

            // Make the submit function async
            document.getElementById("menuForm").addEventListener("submit", async function(event) {
                event.preventDefault();

                const formData = new FormData(form);

                try {
                    const response = await fetch(apiUrl, {
                        method: 'PUT',  // Use PUT method to update the data
                        body: formData,
                    });

                    const result = await response.json();
                    if (result.status === 'sukses') {
                        alert('Menu berhasil diperbarui');
                        window.location.href = 'aturMenu.php';
                    } else {
                        alert(result.message);
                    }
                } catch (error) {
                    console.error('Error updating menu:', error);
                }
            });

            fetchMenuItem(); 
        });
    </script>
</body>
</html>