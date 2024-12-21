<?php
// login.php
session_start();

// Cek jika pengguna sudah login
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
         function loginUser(event) {
            event.preventDefault(); // Mencegah reload halaman
            
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            
            const data = {
                email: email,
                password: password
            };
            fetch('api/auth/login.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    if (data.user_type === 'seller') {
                        window.location.href = 'pages/seller/dashboard.php';
                    } else {
                        window.location.href = 'pages/buyer/home.php';
                    }
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan pada server');
            });
        }
    </script>
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form method="POST" action="" onsubmit="loginUser(event)">
                <input type="email" id="email" name="email" placeholder="Email" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="submit">LOGIN</button>
            </form>
            <p>Belum punya akun? <a href="register.php">Register</a></p>
        </div>
    </div>
</body>
</html>
