<?php
session_start();


if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();


require_once '../model/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    
    if (empty($email)) {
        echo "<script>alert('Email field cannot be empty. Please try again.'); window.location.href = '../view/forgot_password.php';</script>";
        exit();
    }

    
    if (emailExists($email, $conn)) {
        
        $_SESSION['reset_email'] = $email;

        
        header("Location: ../view/otp.php");
        exit();
    } else {
        
        echo "<script>alert('Invalid email address. Please try again.'); window.location.href = '../view/forgot_password.php';</script>";
        exit();
    }
}
?>

<html>
<head>
    <title>Forgot Password</title>
    <link rel="icon" href="../image/r1.png" type="image/gif/png">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        div {
            border: 2px solid black;
            width: 400px;
            padding: 20px;
            margin: 50px auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #reset {
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

        #reset:hover {
            background-color: darkblue;
        }

        p {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div>
        <form method="POST" action=""> 
            <h2 style="text-align: center;">Forgot Password</h2>
            <label for="email">Enter your registered email:</label><br>
            <input type="email" name="email" placeholder="Enter your email" required><br>
            <input id="reset" type="submit" value="Reset Password"><br>
        </form>
        <p><a href="../view/login.php">Back to Login</a></p>
    </div>
</body>
</html>
