<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script>
        function register(event) {
            event.preventDefault(); 
            
            const username = document.getElementById("username").value;
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const phone_number = document.getElementById("phone_number").value;

            const data = {
                username: username,
                email: email,
                password: password,
                phone_number: phone_number
            };

            fetch('api/auth/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                const responseMessage = document.getElementById("responseMessage");

                if (result.status === "success") {
                    responseMessage.style.color = "green";
                    responseMessage.textContent = result.message;

                    setTimeout(() => {
                        window.location.href = "login.php"; 
                    }, 2000);
                } else {
                    responseMessage.style.color = "red";
                    responseMessage.textContent = result.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Terjadi kesalahan saat menghubungi server");
            });
        };

    </script>
</head>
<body>
    <form id="registerForm" onsubmit="register(event)">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required>
        
        <button type="submit">Register</button>
    </form>

    <!-- Untuk menampilkan pesan -->
    <div id="responseMessage"></div>
</body>
</html>