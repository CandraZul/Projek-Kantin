<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Item Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7c485;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 180vh;
        }
        .container {
            background-color: #fff;
            width: 800px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .header {
            background-color: #333;
            color: #f7c485;
            padding: 10px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            position: relative;
        }
        .content {
            padding: 20px;
        }
        .content label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .content input, .content textarea, .content select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .content img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 15px;
            display: block;
        }
        .actions {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background-color: #f7f7f7;
            border-top: 1px solid #ddd;
        }
        .actions a, .actions button {
            text-decoration: none;
            background-color: #f7c485;
            color: #333;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }
        .actions a:hover, .actions button:hover {
            background-color: #e6b472;
        }
        .content img + label {
            margin-top: 20px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container">
    <div class="header">Food Item Details</div>
    <div class="content">
        <img src="" alt="Food Image">

        <label for="id">ID</label>
        <input type="text" id="id" readonly>

        <label for="name">Name</label>
        <input type="text" id="name" readonly>

        <label for="food_type">Menu Type</label>
        <input type="text" id="food_type" readonly>

        <label for="price">Price</label>
        <input type="text" id="price" readonly>

        <label for="stock">Stock</label>
        <input type="text" id="stock" readonly>

        <label for="description">Description</label>
        <textarea id="description" rows="3" readonly><?= htmlspecialchars($item['description']) ?></textarea>
    </div>
    <div class="actions">
        <a href="javascript:history.back()">Back</a>
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
                        $('#id').val(food.food_id);
                        $('#name').val(food.name);
                        $('#description').val(food.description);
                        $('#food_type').val(food.food_type);
                        $('#price').val(food.price);
                        $('#stock').val(food.stock);
                        let imagePath = food.image_url ? food.image_url.replace(/^"|"$/g, '') : 'default-image.jpg';
                        $('img').attr('src', `../${imagePath}`);
                    } else {
                        alert('Gagal mengambil data menu');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil data');
                }
            });
        })
    </script>
</div>

</body>
</html>
