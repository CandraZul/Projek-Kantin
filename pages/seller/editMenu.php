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
    <title>Edit Menu</title>
    
</head>
<body>
    <div class="container">
        <div class="header">Edit Menu</div>
        <div class="form-content">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama_menu">Nama Menu :</label>
                    <input type="text" id="nama_menu" name="nama_menu" required>
                </div>

                <div class="form-group">
                    <label for="harga">Harga :</label>
                    <input type="text" id="harga" name="harga" required>
                </div>

                <div class="form-group">
                    <label for="tipe_menu">Tipe Menu :</label>
                    <select id="tipe_menu" name="tipe_menu" required>
                        <option value="">Pilih Tipe Menu</option>
                        <option value="1">Makanan</option>
                        <option value="2">Minuman</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="gambar_menu">Gambar Menu :</label>
                    <input type="file" id="gambar_menu" name="gambar_menu" accept="image/*" required>
                </div>

                <div class="button-group">
                    <a href="aturMenu.php" class="btn btn-cancel">Batal</a>
                    <button type="submit" name="tambah" class="btn btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>