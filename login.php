<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
</head>
<body>
    <form id="loginForm" onsubmit="loginUser(event)">
        <label>Email:</label>
        <input type="email" id="email" required>
        <label>Password:</label>
        <input type="password" id="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
