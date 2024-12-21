<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/register.css">
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
    <div class="register-container">
        <h2 class="register-title">Register</h2>
        <form id="registerForm" onsubmit="register(event)">
            <div class="form-group">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            
            <div class="form-group">
                <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" required>
            </div>
            
            <button type="submit">Register</button>
        </form>
        
        <div id="responseMessage"></div>
    </div>
</body>
</html>