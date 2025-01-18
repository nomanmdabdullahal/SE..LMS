<html>
<head>
    <title>Login Page</title>
    <link rel="icon" href="../image/r1.png" type="image/gif/png">
    <style>
        body {
            background-image: url('../image/r1.png');
            background-size: cover;
            
            font-family: Arial, sans-serif;
        }

        div {
            width: 450px;
            padding: 20px;
            margin: 40px auto;
            background-color: rgba(255, 255, 255, 0.8); 
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        #email, #password {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #login {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            background-color: blue;
            color: white;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        #login:hover {
            background-color: darkblue;
        }

        .register-link, .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .register-link a, .forgot-password a {
            text-decoration: none;
            font-size: 15px;
            color: blue;
        }

        .register-link a:hover, .forgot-password a:hover {
            color: darkblue;
        }

        
        .forgot-password, .register-link {
            background: none;
            border: none;
            padding: 0;
            box-shadow: none;
        }
    </style>
    <script src="../javascript/login.js" defer></script>
</head>
<body>
    <div>
        <form method="POST" action="../controller/logincheck.php">
            <h2 style="text-align: center;">Login</h2>
            <label for="email"><b>Email:</b></label><br>
            <input id="email" type="email" name="email" placeholder="Enter your email" required><br>

            <label for="password"><b>Password:</b></label><br>
            <input id="password" type="password" name="password" placeholder="Enter your password" required><br>

            <b>Remember Me</b>
            <input type="checkbox" name="remember" id="remember">

            <input id="login" type="submit" name="login" value="Login"><br>
        </form>

        <div class="forgot-password">
            <a href="../view/forgot_password.php"><b>Forgot Password?</b></a>
        </div>

        <div class="register-link">
            <a href="../controller/registration.php"><b>Register here</b></a>
        </div>
    </div>
</body>
</html>
