<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <script>
        function loginUser(event) {
            event.preventDefault();
            
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
                    const responseMessage = document.getElementById("responseMessage");
                    responseMessage.style.color = "green";
                    responseMessage.textContent = data.message;
                    
                    setTimeout(() => {
                        if (data.user_type === 'seller') {
                            window.location.href = 'pages/seller/dashboard.php';
                        } else {
                            window.location.href = 'pages/buyer/home.php';
                        }
                    }, 1000);
                } else {
                    const responseMessage = document.getElementById("responseMessage");
                    responseMessage.style.color = "red";
                    responseMessage.textContent = data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const responseMessage = document.getElementById("responseMessage");
                responseMessage.style.color = "red";
                responseMessage.textContent = 'Terjadi kesalahan pada server';
            });
        }
    </script>
</head>
<body>
    <div class="auth-container">
        <h2 class="auth-title">Login</h2>
        <form onsubmit="loginUser(event)">
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">LOGIN</button>
        </form>
        <div id="responseMessage"></div>
        <p class="auth-link">Belum punya akun? <a href="register.php">Register</a></p>
    </div>
</body>
</html>
